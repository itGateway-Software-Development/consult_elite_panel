<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BlogController;
use App\Http\Controllers\Api\V1\SuccessRateController;
use App\Http\Controllers\Api\V1\SuccessStoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    //blog
    Route::get('blogs', [BlogController::class, 'index']);

    // success rate
    Route::get('success-rates', [SuccessRateController::class, 'index']);

    // success story
    Route::get('success-stories', [SuccessStoryController::class, 'index']);
});
