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
    Route::middleware(\App\Http\Middleware\VerifyResourceType::class)
        ->group(function () {
            Route::get('{resourceType}/{resource}/{question}', [\App\Http\Controllers\StarWarsResourceController::class, 'question']);
            Route::get('{resourceType}/{resource}', [\App\Http\Controllers\StarWarsResourceController::class, 'find']);
            Route::get('{resourceType}', [\App\Http\Controllers\StarWarsResourceController::class, 'index']);
        });
});
