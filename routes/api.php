<?php

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('sw')->group(function() {
    Route::get('planets/population', [\App\Http\Controllers\StarWarsResourceController::class, 'population']);
    Route::get('{resourceType}/{resource}/starships', [\App\Http\Controllers\StarWarsResourceController::class, 'starships']);
    Route::get('{resourceType}/{resource}/species', [\App\Http\Controllers\StarWarsResourceController::class, 'species']);
    Route::get('{resourceType}/{resource}', [\App\Http\Controllers\StarWarsResourceController::class, 'find']);
    Route::get('{resourceType}', [\App\Http\Controllers\StarWarsResourceController::class, 'index']);
});
