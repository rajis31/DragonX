<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private function get_api_key(){
        return env("SHOPIFY_API");
    }

    private function get_api_edition(){
        return env("SHOPIFY_API_EDITION");
    }


    public function get_customer_count(Request $request){
        /**
         * GET: count of customers from owner's shop
         * Note: CURLOPT_HEADER will return the response header
         */

        $API_KEY = $this->get_api_key();
        $API_VER = $this->get_api_edition();
        $SHOP    = $request->shopname;

        $url = "https://".$this->SHOP_URL."/admin/api/".$API_VER."/customers/count.json";
        $headers =array("X-Shopify-Access-Token:".$API_KEY);
        $result = Helpers::get_request($headers, $url);
        
        if( !isset($result["error"]) ){
            $customer_count = $result["count"];
        }

        return isset($customer_count) ? $customer_count : $result;
    }
}
