<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');

Route::middleware('auth:sanctum')->group(function () {
    //Current User
    Route::get('logout', [AuthController::class, 'logout'])->name('api.auth.logout');

    //Profile
    Route::get('profile', [ProfileController::class, 'show'])->name('api.auth.profile');

    //Country
    Route::apiResource('country', CountryController::class);

    //City
    Route::apiResource('city', CityController::class);
});
