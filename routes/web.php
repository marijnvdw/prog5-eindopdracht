<link href="../resources/css/app.css">

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', function() {
    $company = 'Hogeschool Rotterdam';
        return view('contact', [
    'company' => $company
    ]);
})->name('contact');

//Route::get('products/{id}', function(int $id) {
//    return view('products', ['id' => $id]);
//})->name('products');
Route::resource('products', ProductController::class);

//
Route::get('about-us', [AboutUsController::class, 'Show'])->name('about-us');
Route::get('locations', [LocationController::class, 'show'])->name('locations');
//Route::get('/about', function () {
//    return view('about-us');
//})->name('about');

require __DIR__.'/auth.php';
