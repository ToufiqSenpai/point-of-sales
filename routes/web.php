<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;

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

Route::get('/', [IndexController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware('auth:ADMIN,OWNER')->group(function() {
    Route::get('/home', [HomeController::class, 'index']);

//    Supplier endpoint
    Route::get('/supplier', [SupplierController::class, 'index']);
    Route::get('/supplier/add', [SupplierController::class, 'add']);
    Route::post('/supplier/add', [SupplierController::class, 'store']);
    Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::put('/supplier/edit', [SupplierController::class, 'update']);
    Route::delete('/supplier', [SupplierController::class, 'destroy']);


});

Route::middleware('auth:OWNER')->group(function () {

    // User route endpoint
    Route::get('/user', [UserController::class, 'index']);
    Route::delete('/user', [UserController::class, 'destroy']);
    Route::get('/user/add', [UserController::class, 'add']);
    Route::post('/user/add', [UserController::class, 'store']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::put('/user/edit', [UserController::class, 'update']);
});
