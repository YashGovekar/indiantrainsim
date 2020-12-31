<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\FileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ScreenshotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/newsfeed/{id}', [HomeController::class, 'show_newsfeed'])->name('newsfeed.show');

Route::prefix('auth')->middleware('guest')->name('auth.')->group(function () {
    Route::get('/', [AuthController::class, 'auth'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('files')->name('files.')->middleware('auth')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('index');
    Route::get('/create', [FileController::class, 'create'])->name('create');
    Route::post('/', [FileController::class, 'store'])->name('store');
    Route::delete('/{id}', [FileController::class, 'destroy'])->name('destroy');
    Route::get('/hot', [FileController::class, 'hot'])->name('hot');
    Route::get('/manage', [FileController::class, 'manage'])->name('manage');
    Route::post('/report/{id}', [FileController::class, 'report'])->name('files.report');
    Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/comment', [HomeController::class, 'store_comment'])->name('comment.store');
    Route::resource('screenshots', ScreenshotController::class);
});
