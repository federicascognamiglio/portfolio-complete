<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Projects Routes
Route::resource('/projects', ProjectController::class)->middleware(['auth', 'verified']);

// Tags Routes
Route::resource('/tags', TagController::class)->middleware(['auth', 'verified']);

// Tool Routes
Route::resource('/tools', ToolController::class)->middleware(['auth', 'verified']);

// Media Routes
Route::resource('/media', MediaController::class)->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
