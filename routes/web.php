<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\ShareController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','admin'])->prefix('admin')->group(function(){

    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    // file uploads routes
    Route::get('/upload',[FileController::class,'create'])->name('admin.upload');
    Route::post('/upload',[FileController::class,'store'])->name('admin.upload.store');

    // file sharing to user routes
    Route::get('/share',[ShareController::class,'create'])->name('admin.share');
    Route::post('/share',[ShareController::class,'store'])->name('admin.share.store');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
