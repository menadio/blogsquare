<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('posts', PostController::class)->only([
        'index', 'create', 'store',
    ]);
});

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

require __DIR__.'/auth.php';
