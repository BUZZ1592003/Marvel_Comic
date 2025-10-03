<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ComicPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Routes for the web interface (stateful, session, CSRF protected).
| See docs: routes/web.php uses the "web" middleware group by default.
| [4]
*/

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Public Marvel content
|--------------------------------------------------------------------------
| These routes are accessible to everyone.
*/
Route::get('/series', [SeriesController::class, 'index'])->name('series.index'); // [4]
Route::get('/series/{series}', [SeriesController::class, 'show'])->name('series.show'); // implicit binding {series} -> Series model [6]

Route::get('/comics', [ComicController::class, 'index'])->name('comics.index'); // [4]
Route::get('/comics/{comic}', [ComicController::class, 'show'])->name('comics.show'); // implicit binding {comic} -> Comic model [6]
Route::get('/comics/{comic}/pages', [ComicPageController::class, 'index'])->name('comics.pages'); // nested parameter still binds {comic} [6]

Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index'); // [4]
Route::get('/characters/{character}', [CharacterController::class, 'show'])->name('characters.show'); // implicit binding {character} -> Character model [6]
Route::get('/characters/more', function () {
    return view('characters.more');
})->name('characters.more'); // [4]

/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
*/
Route::get('/search', function () {
    $query = request('q', '');
    return view('search', compact('query'));
})->name('search'); // [4]

/*
|--------------------------------------------------------------------------
| Static pages
|--------------------------------------------------------------------------
*/
Route::view('/about', 'about')->name('about'); // Route::view shortcut [4]
Route::view('/contact', 'contact')->name('contact'); // [4]

/*
|--------------------------------------------------------------------------
| Authenticated user area
|--------------------------------------------------------------------------
| Protected by auth and email verification middlewares.
| Attach 'verified' by enabling verification in auth scaffolding.
*/
Route::middleware(['auth', 'verified'])->group(function () { // [2][17]
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); // [2]

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // [2]
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // [2]
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // [2]

    // User-specific Marvel routes (implicit binding {user} -> User model)
    Route::get('/users/{user}/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard'); // [6]
    Route::get('/users/{user}/favorites', [UserController::class, 'favorites'])->name('users.favorites'); // [6]
    Route::get('/users/{user}/reading-history', [UserController::class, 'readingHistory'])->name('users.reading-history'); // [6]
    Route::get('/users/{user}/followed-series', [UserController::class, 'followedSeries'])->name('users.followed-series'); // [6]
});

/*
|--------------------------------------------------------------------------
| Admin (Backpack) routes
|--------------------------------------------------------------------------
| Typically auto-registered by Backpack under /admin and protected by 'admin' middleware.
| Keep this group for custom admin routes if needed.
*/
Route::middleware(['auth', 'admin'])->group(function () {
    // Add custom admin routes here if needed; Backpack’s own routes are already protected. [13][7]
});

/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
| Includes login, registration, password reset, email verification, etc.
*/
require __DIR__ . '/auth.php'; // [4]
