<?php

use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
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

// GUEST HOME ROUTE
Route::get('/', [GuestHomeController::class, 'index'])->name('guest.home');

// ADMIN ROUTES
Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function () {
    // HOME
    Route::get('/', [AdminHomeController::class, 'index'])->name('home');
    // ### ADMIN PROJECT ROUTES ###
    Route::resource('projects', ProjectController::class);
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
