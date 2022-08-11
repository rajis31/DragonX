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

        //  $this->validate($request,[
        //     "username" => "required",
        //     "password" => "required"
        //  ]);

        // $credentials = $request->only("username","password");
        // if(Auth::attempt($credentials)){
        //     return response()->json([
        //         "message" => "Login Successful",
        //         "success" => "True"
        //     ],200);
        // }

        return response()->json([
            "message" => "Login Not Successful",
            "success" => "false"
        ],420);

    }


    public function Register(Request $request){
        /**
         *  Check Registration information and add to database
         * 
         */ 

        $this->validate($request,[
            "username"=>"required|min:3|unique:users",
            "email"   => "required|unique:users",
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
        ]);

        try{

            $new_user = new User;
            $new_user->first_name = $request->first_name;
            $new_user->last_name = $request->last_name;
            $new_user->email = $request->email;
            $new_user->username = $request->username;
            $new_user->password = Hash::make($request->password);
            $new_user->save();
            return redirect()->route("login")
                             ->with([ "message"=>"User Account has been successfully created :)"]) 
                             ->with(["type" => "message"]);



        }catch (Exception $e){
            return back()->withErrors("Cannot save user, try again.");
        }
    }


}
