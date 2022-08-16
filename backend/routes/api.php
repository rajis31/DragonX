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
Route::post("/login", [UserController::class,'login']);

// Shops
Route::get("/install",[ShopController::class,"install"]);
Route::get("/token",  [ShopController::class,"generate_token"]);