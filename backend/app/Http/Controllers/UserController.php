<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function login(Request $request){
        /**
         * Check login credentials
         */

         $this->validate($request,[
            "shopname" => "required",
            "password" => "required"
         ]);

        $credentials = $request->only("shopname","password");
        if(Auth::attempt($credentials)){
            return response()->json([
                "message" => "Login Successful",
                "success" => "True"
            ],200);
        }

        return response()->json([
            "message" => "Login Not Successful",
            "success" => "false"
        ],420);

    }

}
