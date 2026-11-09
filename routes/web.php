<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemeriksaanController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');
    Route::get('pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('pemeriksaan.create');
    Route::post('pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
});

require __DIR__.'/settings.php';
