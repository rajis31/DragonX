<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class ShopController extends Controller
{
    public function installation(Request $request){
        $shop         = request->get("shop");
        $api_key      = env("SHOPIFY_API");
        $scopes       = env("SHOPIFY_SCOPES");
        $redirect_uri = "https://dragonx.dev-top.com/api/generate_token";
        $nonce        =  bin2hex(random_bytes(12));


        if( User::where("shopname",$shop)->exists() === null ){
            $user            = new User;
            $user->shopname  = $shop;
            $user->nonce      = $nonce;
            $user->save();
        } else{
            $user_found = User::where("shopname",$shop)->first();
            $user_found->nonce        = $nonce;
            $user_found->api_key      = null;
            $user_found->access_token = null;
            $user_found->save();
        }

        $install_url = $this->generate_install_url(
                                $shop,
                                $api_key,
                                $scopes,
                                $redirect_uri,
                                $nonce
                            );

        return Redirect::to($install_url);
    }

    private function generate_install_url($shop, $api_key,$scopes,$redirect_uri, $nonce){
        $install_url = "https://" . 
                        $shop . 
                        ".myshopify.com/admin/oauth/authorize?client_id=" . 
                        $api_key . 
                        "&scope=" . $scopes . 
                        "&redirect_uri=" . urlencode($redirect_uri).
                        "&state=". $nonce.
                        "&grant_options[]=per_user";
        return $install_url;
    }

    public function generate_token(Request $request){
        
        $code      = $request->get("code");
        $hmac      = $request->get("hmac");
        $nonce     = $request->get("nonce");
        $host      = $request->get("host");
        $shop      = $request->get("shop");
        $timestamp = $request->get("timestamp");
        $secret    = env("SHOPIFY_SECRET");
        $api_key   = env("SHOPIFY_API");

        $checks = $this->check_install(
            $hmac,
            $code,
            $nonce,
            $host,
            $shop,
            $timestamp,
            $secret
        );

        if($checks){
            $query = array(
                "client_id"     => $api_key, 
                "client_secret" => $secret, 
                "code"          => $code
              );
              
              // Generate access token URL
              $access_token_url = "https://" . $shop . "/admin/oauth/access_token";
              
              // Configure curl client and execute request
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_URL, $access_token_url);
              curl_setopt($ch, CURLOPT_POST, count($query));
              curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($query));
              $result = curl_exec($ch);
              curl_close($ch);
              
              // Store the access token
              $result = json_decode($result, true);
              $access_token = $result['access_token'];

              dd($result);
        }

    }

    private function check_install($hmac, $code, $nonce, $host, $shop, $timestamp, $secret){

        // verfiy nonce 
        $nonce_db = User::select("nonce")
                        ->where("shopname", $shop)
                        ->first();
        
        if($nonce_db !== $nonce){
            return false;
        }

        // verify hmac
        $params = [
            "code"      => $code,
            "host"      => $host,
            "shop"      => $shop,
            "state"     => $nonce,
            "timestamp" => $timestamp
        ];

        ksort($params);

        $computed_hmac = hash_hmac('sha256', http_build_query($params), $secret);

        if ( !hash_equals($hmac, $computed_hmac) ) {
            return false;
        } 

        // Check shop 
        if (!preg_match("/^(https|http)\:\/\/[a-zA-Z0-9][a-zA-Z0-9\-]*\.myshopify\.com\//",$shop)){
            return false;
        }

        return true;
    }


}
