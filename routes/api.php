<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get("/", function() {
//     return "API is working properly.";
// })->name("api.home");

Route::apiResource("posts", PostController::class);

Route::post("register", [AuthController::class, "register"]); 
Route::post("login", [AuthController::class, "login"]); 
Route::post("logout", [AuthController::class, "logout"])->middleware('auth:sanctum'); 

Route::prefix("v1")->group(function() {
    Route::get("/", function() {
        return "API v1 is working properly.";
    })->name("api.v1.home");
});
