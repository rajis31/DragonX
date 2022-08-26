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
Route::post("/current_user", [UserController::class,'current_user'])->name("current_user");


// Install
Route::get("/installation",[ShopController::class,"installation"])->name("installation");
Route::get("/token",  [ShopController::class,"generate_token"])->name("token");