<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
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

Route::post('/auth/signup',[SignupController::class, 'signup']);
Route::post('/auth/login',[LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/auth/logout',[LogoutController::class, 'logout']);
    Route::get('/app/getUsers',[UserController::class, 'getUser']);
    Route::post('/app/updatePicture', [UserController::class, 'uploadPicture']);
});
