<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Route;

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

Route::controller(IndexController::class)->group(function () {
    Route::get('/', 'index')->name('index.index');
    Route::get('/login', 'login')->name('index.login');
    Route::get('/register', 'register')->name('index.register');
    Route::post('/', 'index')->name('index.search');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/register', 'register')->name('auth.register');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::controller(ProductController::class)->group(function () {
    Route::middleware([User::class])->post('/order', 'order')->name('product.order');
});

Route::middleware([Admin::class])
    ->controller(DashboardController::class)
    ->prefix('/admin')
    ->group(function () {
    Route::get('/', 'show')->name('admin.show');
    Route::get('/create', 'createProductView')->name('admin.create');
    Route::post('/create', 'store')->name('admin.store');
    Route::get('/edit/{id}', 'editProductView')->name('admin.edit');
    Route::post('/edit/{id}', 'update')->name('admin.update');
    Route::post('/delete/{id}', 'destroy')->name('admin.destroy');
});
