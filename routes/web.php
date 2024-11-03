<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CategoryController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/', LocationController::class);
Route::resource('locations', LocationController::class);

Route::post('/items/{id}/toggle-status', [LocationController::class, 'toggleStatus'])->name('item.toggleStatus');

Route::get('locations/create', [LocationController::class, 'create'])->name('locations.create');

//Route::resource('admin', CategoryController::class);

Route::get('/admin', [CategoryController::class, 'index'])->name('admin');
Route::post('/admin/store', [CategoryController::class, 'store'])->name('admin.store');
Route::post('/admin/update', [CategoryController::class, 'update'])->name('admin.update');
Route::post('/admin/delete', [CategoryController::class, 'destroy'])->name('admin.destroy');
Route::get('/locations/{location}/edit/{user}', [LocationController::class, 'edit'])->name('locations.edit');
Route::delete('/locations/{location}/destroy/{user}', [LocationController::class, 'destroy'])->name('locations.destroy');

//Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//    Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category']);
//});
//Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//    Route::resource('categories', CategoryController::class)->except(['show']);
//});

require __DIR__.'/auth.php';
