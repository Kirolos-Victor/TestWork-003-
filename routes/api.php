<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LectureController;
use App\Http\Controllers\API\UserController;
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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class)->except('show');
    Route::post('users/{user}/attach-lecture', [UserController::class, 'attachLecture']);
    Route::apiResource('lectures', LectureController::class)->except('show');
    Route::post('lectures/{lecture}/attach-user', [LectureController::class, 'attachUser']);
});
