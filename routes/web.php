<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PriceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/price/create/{product}', [PriceController::class, 'create'])->name('price.create');
Route::post('/price/create/{product}', [PriceController::class, 'store'])->name('price.store');
Route::get('/price/edit/{price}', [PriceController::class, 'edit'])->name('price.edit');
Route::put('/price/edit/{price}', [PriceController::class, 'update'])->name('price.update');
Route::delete('/price/{price}', [PriceController::class, 'destroy'])->name('price.destroy');

Auth::routes(['reset' => false, 'confirm'=>false]);
