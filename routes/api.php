<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;

Route::post('/register',[UserController::class,'register']);
   

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',function (Request $request){
        return $request->user();
    });
    
    Route::post('/logout',[UserController::class, 'logout']);
    Route::delete('/account',[UserController::class, 'deleteAccount']);
    Route::resource('/buku', BukuController::class);
   


});

Route::post('/login',[UserController::class, 'login']);

