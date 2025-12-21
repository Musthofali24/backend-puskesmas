<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Blog API Routes (Public - No Authentication Required)
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/latest', [BlogController::class, 'latest']);
    Route::get('/popular', [BlogController::class, 'popular']);
    Route::get('/category/{category}', [BlogController::class, 'byCategory']);
    Route::get('/{slug}', [BlogController::class, 'show']);
    Route::get('/{slug}/related', [BlogController::class, 'related']);
});

// Staff API Routes (Public - No Authentication Required)
Route::prefix('staff')->group(function () {
    Route::get('/', [StaffController::class, 'index']);
    Route::get('/all', [StaffController::class, 'all']);
    Route::get('/{id}', [StaffController::class, 'show']);
});
