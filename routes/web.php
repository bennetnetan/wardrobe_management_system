<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClothingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');


Route::get('dashboard', [ClothingController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Clothing routes
Route::get('clothing', [ClothingController::class, 'index'])->middleware(['auth', 'verified'])->name('clothing.index');
Route::get('clothing/create', [ClothingController::class, 'create'])->middleware(['auth', 'verified'])->name('clothing.create');
Route::post('clothing', [ClothingController::class, 'store'])->middleware(['auth', 'verified'])->name('clothing.store');
Route::get('clothing/{clothing}', [ClothingController::class, 'edit'])->middleware(['auth', 'verified'])->name('clothing.edit');
Route::put('clothing/{clothing}', [ClothingController::class, 'update'])->middleware(['auth', 'verified'])->name('clothing.update');
Route::delete('clothing/{clothing}', [ClothingController::class, 'destroy'])->middleware(['auth', 'verified'])->name('clothing.destroy');

// Category routes
Route::get('categories', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('categories.store');
Route::get('categories/{category}', [CategoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('categories.destroy');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';