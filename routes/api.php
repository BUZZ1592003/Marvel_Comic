<?php
// routes/api.php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\ComicPageController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReadingHistoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Test route
Route::get('test', function() {
    return response()->json(['message' => 'API is working']);
});


// User resource routes
Route::apiResource('users', UserController::class);

// Additional user routes
Route::prefix('users/{user}')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
    Route::get('/favorites', [UserController::class, 'favorites'])->name('users.favorites');
    Route::get('/reading-history', [UserController::class, 'readingHistory'])->name('users.reading-history');
    Route::get('/followed-series', [UserController::class, 'followedSeries'])->name('users.followed-series');
});

// Public resources
Route::apiResource('series', SeriesController::class);
Route::apiResource('comics', ComicController::class);       // working
Route::apiResource('characters', CharacterController::class); // working

// Auth-required resources
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('favorites', FavoriteController::class);
    Route::apiResource('ratings', RatingController::class);
    Route::apiResource('reading-history', ReadingHistoryController::class);
});

//comic pages
Route::get('comics/{comic}/pages', [ComicPageController::class, 'index']);
Route::post('comic-pages', [ComicPageController::class, 'store']);
Route::put('comic-pages/{page}', [ComicPageController::class, 'update']);
Route::delete('comic-pages/{page}', [ComicPageController::class, 'destroy']);