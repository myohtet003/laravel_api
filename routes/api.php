<?php

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

Route::prefix("v1")->group(function() {
    Route::get("/", function() {
        return "API v1 is working properly.";
    })->name("api.v1.home");
});
