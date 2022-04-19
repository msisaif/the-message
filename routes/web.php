<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AyahController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\HadithController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JuzController;
use App\Http\Controllers\KidsZoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\RamadanChecklistController;
use App\Http\Controllers\RamadanChecklistFieldController;
use App\Http\Controllers\RecentVideoController;
use App\Http\Controllers\SuraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/phpinfo', [Controller::class, 'phpinfo']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/quran', [QuranController::class, 'index'])->name('quran.index');
Route::get('/quran/{sura}/{range?}', [QuranController::class, 'sura'])->name('quran.show');

Route::get('/hadith', [HadithController::class, 'index'])->name('hadith.index');

Route::get('/course', [CourseController::class, 'index'])->name('course.index');

Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{post}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/kids-zone', [KidsZoneController::class, 'index'])->name('kids-zone.index');

Route::get('/video', [RecentVideoController::class, 'index'])->name('video.index');

Route::get('/donate', [DonateController::class, 'index'])->name('donate.index');

Route::get('/ramadan-checklist', [RamadanChecklistController::class, 'list'])->name('ramadan-checklist.list');

Route::get('/ramadan-checklist/form/{date?}', [RamadanChecklistController::class, 'form'])->name('ramadan-checklist.form')->middleware('auth');

Route::post('/ramadan-checklist', [RamadanChecklistController::class, 'save'])->name('ramadan-checklist.save')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resources([
        'admins'            => AdminController::class,
        'users'             => UserController::class,
        'suras'             => SuraController::class,
        'juzs'              => JuzController::class,
        'ayahs'             => AyahController::class,
        'posts'             => PostController::class,
        'classifications'   => ClassificationController::class,
        'videos'            => VideoController::class,
        'categories'        => CategoryController::class,
        'checklist-fields'  => RamadanChecklistFieldController::class,
    ]);
});

Route::get('quran-api/{option?}', [CollectionController::class, 'apiToSql']);
Route::get('/collection', [CollectionController::class, 'create'])->name('collection');
Route::post('/collection', [CollectionController::class, 'store']);