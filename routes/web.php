<?php

use App\Http\Controllers\ProductsController;
use App\Http\Livewire\AddProductPage;
use App\Http\Livewire\CategorySettingPage;
use App\Http\Livewire\ProductPage;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/settings/categories', CategorySettingPage::class)->name('settings.categories');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/products', ProductPage::class)->name('products');
    Route::get('/products/add', AddProductPage::class)->name('products.add');
});
