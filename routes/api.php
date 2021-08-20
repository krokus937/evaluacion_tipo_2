<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryUserLoginController;

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

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    //History
    Route::get('/historyIp',        [HistoryUserLoginController::class, 'index']);
    Route::post('/history/search',  [HistoryUserLoginController::class, 'search']);
    Route::put('/history/{id}',     [HistoryUserLoginController::class, 'update']);
    Route::delete('/history/{id}',  [HistoryUserLoginController::class, 'destroy']);



});
