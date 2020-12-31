<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\ScreenshotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('return-json')->group(function () {
    Route::get('/files', [FileController::class, 'index'])->name('files');
    Route::get('/screenshots', [ScreenshotController::class, 'index'])->name('screenshots');

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
