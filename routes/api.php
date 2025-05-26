<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlatformController;
use App\Models\Platform;
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'getUser']);
    Route::post('updateProfile', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);

});
Route::apiResource("posts",PostController::class);
Route::apiResource("platforms",PlatformController::class);
Route::post('posts/{post}/toggle-platform', [PlatformController::class, 'makeToggle'])->middleware('auth:api');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
});