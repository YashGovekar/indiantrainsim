<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\FileSectionController;
use App\Http\Controllers\Admin\NewsFeedController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('file-sections', FileSectionController::class);
    Route::get('file-sections/{id}/files', [FileSectionController::class, 'files'])->name('file-sections.files');
    Route::resource('files', FileController::class);
    Route::get('/files/download/{id}', [FileController::class, 'download'])->name('files.download');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::resource('news-feeds', NewsFeedController::class);
});
