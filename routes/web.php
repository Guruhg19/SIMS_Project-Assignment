<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return redirect()->route('products.index');
// });

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware('auth')->group(function (){
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    // Daftar produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Form tambah produk
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    // Simpan produk baru
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // Form edit produk
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    // Update produk
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    // Hapus produk
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');

    Route::get('/profile',[ProfileController::class, 'index'])->name('profile');
});

Route::middleware('guest')->group(function (){
    Route::get('/user/login', [UserController::class, 'index'])->name('login');
    Route::post('/user/login', [UserController::class, 'doLogin'])->name('login.post');
    Route::get('/user/register', [UserController::class, 'register'])->name('register');
    Route::post('/user/register', [UserController::class, 'doRegister'])->name('register.post');
});

Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');
