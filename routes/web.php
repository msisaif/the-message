<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KidsZoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/quran', [QuranController::class, 'index'])->name('quran.index');

Route::get('/hadith', [HadithController::class, 'index'])->name('hadith.index');

Route::get('/course', [CourseController::class, 'index'])->name('course.index');

Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{post}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/kids-zone', [KidsZoneController::class, 'index'])->name('kids-zone.index');

Route::get('/donate', [DonateController::class, 'index'])->name('donate.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'admins'        => AdminController::class,
        'users'         => UserController::class,
        'posts'         => PostController::class,
    ]);
});

