<?php

use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::post('users/login', [UserController::class, 'login']);
    Route::apiResource('users', UserController::class)->only('store');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('users/logout', [UserController::class, 'logout']);

        Route::get('shows/series', [ShowsController::class, 'getSeries']);
        Route::get('shows/movies', [ShowsController::class, 'getMovies']);

        Route::get('shows/top-series', [ShowsController::class, 'getTopSeries']);
        Route::get('shows/top-movies', [ShowsController::class, 'getTopMovies']);

        Route::put('shows/add-favorite/{show_id}', [FavoritesController::class, 'add']);
        Route::put('shows/delete-favorite/{show_id}', [FavoritesController::class, 'delete']);
        Route::get('shows/get-favorites', [FavoritesController::class, 'getFavorites']);

        Route::get('shows/{show_id}', [ShowsController::class, 'getShowDetails']);
    });

});
