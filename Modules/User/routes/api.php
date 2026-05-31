<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('users', UserController::class)->names('user');
// });

Route::middleware('auth:sanctum')->prefix('v1/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
        // Route::apiResource('users',  UserController::class);
    });
// 
// Route::middleware('auth:sanctum')
//     ->apiResource(
//         'users',
//         UserController::class
//     );
