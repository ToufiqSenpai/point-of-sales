<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductUnitController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductController;

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

//    Product unit endpoint
    Route::get('/product/unit', [ProductUnitController::class, 'index']);
    Route::get('/product/unit/add', [ProductUnitController::class, 'add']);
    Route::post('/product/unit/add', [ProductUnitController::class, 'store']);
    Route::get('/product/unit/edit/{id}', [ProductUnitController::class, 'edit']);
    Route::put('/product/unit/edit', [ProductUnitController::class, 'update']);
    Route::delete('/product/unit', [ProductUnitController::class, 'destroy']);

//    Product category endpoint
    Route::get('/product/category', [ProductCategoryController::class, 'index']);
    Route::get('/product/category/add', [ProductCategoryController::class, 'add']);
    Route::post('/product/category/add', [ProductCategoryController::class, 'store']);
    Route::get('/product/category/edit/{id}', [ProductCategoryController::class, 'edit']);
    Route::put('/product/category/edit', [ProductCategoryController::class, 'update']);
    Route::delete('/product/category', [ProductCategoryController::class, 'destroy']);

//    Product brand endpoint
    Route::get('/product/brand', [ProductBrandController::class, 'index']);
    Route::get('/product/brand/add', [ProductBrandController::class, 'add']);
    Route::post('/product/brand/add', [ProductBrandController::class, 'store']);
    Route::get('/product/brand/edit/{id}', [ProductBrandController::class, 'edit']);
    Route::put('/product/brand/edit', [ProductBrandController::class, 'update']);
    Route::delete('/product/brand', [ProductBrandController::class, 'destroy']);

//    Product endpoint
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/add', [ProductController::class, 'add']);
    Route::post('/product/add', [ProductController::class, 'store']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/product/edit', [ProductController::class, 'update']);
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
