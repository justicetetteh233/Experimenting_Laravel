<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/products', ProductController::class);

Route::post('/login', [LoginController::class, 'apiLogin']);
// Route::post('/login', function(){
//     return response()->json(['message' => 'you are logining in ']);
// });


Route::middleware('auth:sanctum')->get('/protected-route', function () {
    return response()->json(['message' => 'This route is protected!']);
});

Route::middleware('auth:sanctum','apiKey')->get('/protected-api', function () {
    return response()->json(['message' => 'This route  is protected with an api key']);
});
