<?php

use App\Http\Controllers\PlatformController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('welcome');
Route::get('/dashboard', [PostController::class, 'indexDashboard'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);
Route::resource('platforms', PlatformController::class);
Route::get('/platform_setting/{postId}', [PlatformController::class, 'toggle'])->name('platform_setting');
Route::post('/toggle_platform/{postId}', [PlatformController::class, 'makeToggle'])->name('toggle_platform');

require __DIR__.'/auth.php';
