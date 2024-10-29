<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('about-us', [AboutUsController::class, 'Show'])->name('about-us');

Route::resource('/', LocationController::class);
Route::resource('locations', LocationController::class);//->names([
//    'index' => 'locations.index',
//    'create' => 'locations.create',
//    'store' => 'locations.store',
//    'show' => 'locations.show',
//    'edit' => 'locations.edit',
//    'update' => 'locations.update',
//    'destroy' => 'locations.destroy',
//]);

// Make sure this route exists in web.php
Route::post('/items/{id}/toggle-status', [LocationController::class, 'toggleStatus'])->name('item.toggleStatus');



Route::get('locations/create', [LocationController::class, 'create'])->name('locations.create');

require __DIR__.'/auth.php';
