<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/login', LoginController::class);
        Route::post('/logout', LogoutController::class);
    });  

    // required login    
    Route::middleware('auth:sanctum')->group(function () {
       
        Route::apiResource('forms', FormController::class)
           ->except('show');

    });

    // not required login
    Route::get('forms/{form:slug}', [FormController::class, 'show']);
});