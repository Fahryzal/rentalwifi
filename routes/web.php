<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WifiController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/user/login', [UserController::class, 'login'])->name('login');
Route::post('/user/authenticate', [UserController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [WifiController::class, 'AllowedUsers']);
    Route::get('/wifi-setting/acl', [WifiController::class, 'BlockUsers']);
    Route::post('/block', [WifiController::class, 'block']);
    Route::post('/wifi-setting/unblock', [WifiController::class, 'unblock']);
    Route::post('/wifi-setting/create-or-update', [WifiController::class, 'createOrUpdateSetting']);
});
