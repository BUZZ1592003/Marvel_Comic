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
Route::apiResource('users', UserController::class)->names('api.users');

    // Additional user routes
Route::prefix('users/{user}')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('api.users.dashboard');
    Route::get('/favorites', [UserController::class, 'favorites'])->name('api.users.favorites');
    Route::get('/reading-history', [UserController::class, 'readingHistory'])->name('api.users.reading-history');
    Route::get('/followed-series', [UserController::class, 'followedSeries'])->name('api.users.followed-series');
});

    // Public resources
Route::apiResource('series', SeriesController::class)->names('api.series');
Route::apiResource('comics', ComicController::class)->names('api.comics');       // working
Route::apiResource('characters', CharacterController::class)->names('api.characters'); // working

    // Auth-required resources
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('favorites', FavoriteController::class)->names('api.favorites');
    Route::apiResource('ratings', RatingController::class)->names('api.ratings');
    Route::apiResource('reading-history', ReadingHistoryController::class)->names('api.reading-history');
});

    //comic pages
Route::get('comics/{comic}/pages', [ComicPageController::class, 'index']);
Route::post('comic-pages', [ComicPageController::class, 'store']);
Route::put('comic-pages/{page}', [ComicPageController::class, 'update']);
Route::delete('comic-pages/{page}', [ComicPageController::class, 'destroy']);