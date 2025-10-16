<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\UserModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return 'hello';
// });

Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/modules', ModuleController::class);
    Route::post('/modules/{id}/activate', [UserModuleController::class, 'activate']);
    Route::post('/modules/{id}/deactivate', [UserModuleController::class, 'deactivate']);
    
    Route::get('/links', [ShortLinkController::class, 'index']);
    Route::post('/shorten', [ShortLinkController::class, 'store']);
    Route::delete('/links/{id}', [ShortLinkController::class, 'destroy']);
});