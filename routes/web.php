<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/transaction', [HomeController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::delete('/user', [UserController::class, 'destroy']);
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user/create', [UserController::class, 'store']);
