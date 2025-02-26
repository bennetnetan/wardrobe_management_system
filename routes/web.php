<?php

use App\Http\Controllers\ClothingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Clothing routes
Route::get('clothing', [ClothingController::class, 'index'])->middleware(['auth', 'verified'])->name('clothing.index');
Route::get('clothing/create', [ClothingController::class, 'create'])->middleware(['auth', 'verified'])->name('clothing.create');
Route::post('clothing', [ClothingController::class, 'store'])->middleware(['auth', 'verified'])->name('clothing.store');
Route::get('clothing/{clothing}', [ClothingController::class, 'edit'])->middleware(['auth', 'verified'])->name('clothing.edit');
Route::put('clothing/{clothing}', [ClothingController::class, 'update'])->middleware(['auth', 'verified'])->name('clothing.update');
Route::delete('clothing/{clothing}', [ClothingController::class, 'destroy'])->middleware(['auth', 'verified'])->name('clothing.destroy');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';