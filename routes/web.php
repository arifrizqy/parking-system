<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/profile');

Route::get('/parking-log', [App\Http\Controllers\ParkingLogController::class, 'index'])->name('parking-log');
Route::post('/parking-log', [App\Http\Controllers\ParkingLogController::class, 'store'])->name('parking-log.store');
Route::put('/parking-log/{parkingLog}/leave', [App\Http\Controllers\ParkingLogController::class, 'leave'])->name('parking-log.leave');
Route::delete('/parking-log/{parkingLog}', [App\Http\Controllers\ParkingLogController::class, 'destroy'])->name('parking-log.destroy');

Route::post('/vehicles', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
Route::put('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destroy');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/qr/download', [App\Http\Controllers\ProfileController::class, 'generateQrMember'])->name('profile.qr.download');

Route::get('/guests', [App\Http\Controllers\GuestController::class, 'index'])->name('guests');
Route::post('/guests', [App\Http\Controllers\GuestController::class, 'store'])->name('guests.store');

Route::get('/api/member-data/{id}', [App\Http\Controllers\Api\MemberDataController::class, 'show']);
Route::get('/api/guest-data/{id}', [App\Http\Controllers\Api\GuestLogDataController::class, 'show']);
