<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\ResponseController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/login', LoginController::class);
        Route::post('/logout', LogoutController::class);

        Route::get('/me', function () {
            return auth('sanctum')->user();
        });
    });  

    // === required login ===    
    Route::middleware('auth:sanctum')->group(function () {
       
        Route::apiResource('forms', FormController::class)
            ->except('show');

        Route::apiResource('forms.questions', QuestionController::class)
            ->only(['store', 'destroy']);

        Route::apiResource('forms.responses', ResponseController::class)
            ->only(['index', 'store']);
    });

    // === not required login ===

    // get form detail
    Route::get('forms/{slug}', [FormController::class, 'show']);
});