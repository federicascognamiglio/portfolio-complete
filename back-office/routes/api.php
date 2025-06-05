<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Projects Index
Route::get('projects', [ProjectController::class, 'index']);

// Projects Show
Route::get('projects/{slug}', [ProjectController::class, 'show']);

// Categories Index
Route::get('categories', [CategoryController::class, 'index']);