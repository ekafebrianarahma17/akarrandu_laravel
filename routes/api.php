<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Api\WargasController;
use App\Http\Controllers\UserController;
use Tymon\JWTAuth\Facades\JWTAuth;

// Route::namespace('Auth')->group(function () {

//     Route::post('register', [RegisterController::class, '__invoke']);
//     Route::post('login', [LoginController::class, 'login']);
//     Route::post('logout', [LogoutController::class, 'logout']);
// });


Route::namespace('Api')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('save_user_info', [AuthController::class, 'saveUserInfo'])->middleware('jwtAuth');
});


Route::namespace('Api')->middleware('jwtAuth')->group(function () {
    Route::post('posts/create', [WargasController::class, 'create']);
    Route::post('delete', [WargasController::class, 'delete']);
    Route::post('update', [WargasController::class, 'update']);
    Route::get('posts', [WargasController::class, 'posts']);
});

Route::get('wargas/{warga}', [WargaController::class, 'show']);
Route::get('wargas', [WargaController::class, 'index']);



Route::get('user', [UserController::class, '__invoke']);
