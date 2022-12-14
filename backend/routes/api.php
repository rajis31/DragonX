<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Users
Route::post("/login", [UserController::class,'login'])->name("login");
Route::post("/register", [UserController::class,'register'])->name("register");

//customers

// Install
Route::get("/installation",[ShopController::class,"installation"])
            ->name("installation");
Route::get("/token",  [ShopController::class,"generate_token"])
            ->name("token");
Route::post("/apikey", [ShopController::class,'get_api_key'])
            ->name("apikey");
Route::get("/get_emded_host", [ShopController::class,'getHost'])
            ->name("getEmbedHost");
Route::post("/set_emded_host", [ShopController::class,'setHost'])
            ->name("setEmbdedHost");
