<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/parking-log');

Route::get('/parking-log', [App\Http\Controllers\ParkingLogController::class, 'index'])->name('parking-log');

Route::post('/vehicles', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
Route::put('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destroy');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::get('/guests', [App\Http\Controllers\GuestController::class, 'index'])->name('guests');
Route::post('/guests', [App\Http\Controllers\GuestController::class, 'store'])->name('guests.store');
