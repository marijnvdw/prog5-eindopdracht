<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;

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

require __DIR__.'/auth.php';
