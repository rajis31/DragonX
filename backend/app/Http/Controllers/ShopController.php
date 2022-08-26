<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;



class ShopController extends Controller
{
    public function installation(Request $request){
        $shop         = $request->get("shop");
        $hmac         = $request->get("hmac");
        $timestamp    = $request->get("timestamp");
        $api_key      = env("SHOPIFY_API");
        $scopes       = env("SHOPIFY_SCOPES");
        $redirect_uri = "https://dragonx.dev-top.com/api/token";
        $nonce        =  bin2hex(random_bytes(12));

        if( $shop === null ){
            return response()->view('errors.404');
        }

        if($shop !== null && User::select("access_token")->
           where("shopname",$shop)->value("access_token") !== null)
        {
            return Redirect::to(env("APP_URL")."/login");
        }

        if( !User::where("shopname",$shop)->exists() ){
            $user             = new User;
            $user->username   = $shop;
            $user->shopname   = $shop;
            $user->nonce      = $nonce;
            $user->timestamp  = $timestamp;
            $user->hmac       = $hmac;
            $user->save();
        } else{
            $user_found = User::where("shopname",$shop)->first();
            $user_found->nonce        = $nonce;
            $user_found->hmac         = $hmac;
            $user_found->timestamp    = $timestamp;
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
                        "/admin/oauth/authorize?client_id=" . 
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
        $nonce     = $request->get("state");
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

              // Update store account with access token 
              $user = User::where("shopname", $shop)->first();
              $user->access_token = $access_token;
              $user->save();

              $pos  = strpos($shop,".");
              $shop = substr($shop,0,$pos); 

              return Redirect::to("https://dragonx.dev-top.com/register/".$shop);
        } else {
            return view("installation");
        }

    }

    private function check_install($hmac, $code, $nonce, $host, $shop, $timestamp, $secret){
        
        // verfiy nonce 
        $nonce_db = User::where("shopname", $shop)
                        ->pluck("nonce")
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
        
        // --- REMOVE LATER ---
        // $errors =[];
        // $errors["nonce_db"] = $nonce_db;
        // $errors["nonce_req"] = $nonce;
        // $errors["computed_hmac"] = $computed_hmac;
        // $errors["hmac"] = $hmac;
        // $errors["shop"] = $shop;
        // $errors["shop_match"] = preg_match("/^[a-zA-Z0-9][a-zA-Z0-9\-]*.myshopify.com/",$shop);

        if ( !hash_equals($hmac, $computed_hmac) ) {
            return false;
        } 

        // Check shop 
        if (!preg_match("/^[a-zA-Z0-9][a-zA-Z0-9\-]*.myshopify.com/",$shop)){
            return false;
        }

        return true;
    }


}
