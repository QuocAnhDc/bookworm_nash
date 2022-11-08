<?php

use App\Http\Api\BookApi;
use App\Http\Api\FilterApi;
use App\Http\Api\OrderApi;
use App\Http\Api\ReviewBookApi;
use App\Http\Controllers\LoginController;
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
Route::post('session', [LoginController::class, 'store'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('session', [LoginController::class, 'logout'])->name('api.logout');
});

Route::get('books/filter', [BookApi::class, 'filter']);

Route::get('books/{book}/reviews/filter', [ReviewBookApi::class, 'filter']);

Route::resource('books', BookApi::class);

Route::resource('books.reviews', ReviewBookApi::class);

Route::resource('filters', FilterApi::class)->only([
    'index'
]);

