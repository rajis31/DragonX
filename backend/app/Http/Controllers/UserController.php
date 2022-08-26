<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

        if(Auth::attempt(["shopname" => $request->shopname, 
                          "password" => $request->password] ))
        {
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

    public function register(Request $request){

        $shop = User::where("shopname", $request->shopname)
                        ->first(); 
        
        try {
            $shop->update([
                "email"    => $request->email,
                "password" => Hash::make($request->password),
                "username" => $request->shopname
            ]);

            return response()->json([
                "message" => "Successfully Stored",
                "success" => true 
            ],200);
            

        } catch(Exception $e) {
            return response()->json([
                "message" => "Could not store",
                "success" => false 
            ],420);

        } 
    }

    public function current_user(){
        return response()->json([
            "Auth id" => Auth::id()
        ],200);
    }

}
