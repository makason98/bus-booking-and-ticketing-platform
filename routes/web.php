<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\StopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestRouteController;
use App\Http\Controllers\Admin\Destinations;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect()->route('home');
});
Route::match(['get', 'post'], '/rezervare', [GuestRouteController::class, 'index'])->name('home');
Route::post('/rezervare-form', [GuestRouteController::class, 'create'])->name('create');
Route::post('/rezervare-select-intors', [GuestRouteController::class, 'selectIntors'])->name('selectIntors');
Route::post('/save-seats', [SeatController::class, 'saveSeats'])->name('save-seats');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/show', [ReservationController::class, 'show'])->name('reservations.show');
Route::get('dashboards/download-pdf', [DashboardController::class, 'downloadPdf'])->name('admin.dashboards.downloadPdf');



// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('dashboards', DashboardController::class)->names('admin.dashboards');
    Route::resource('routes', RouteController::class)->names('admin.routes');
    Route::resource('destinations', Destinations::class)->names('admin.destinations');
    Route::resource('users', UserController::class)->names('admin.users');

    Route::prefix('routes/{route}')->group(function () {
        Route::resource('stops', StopController::class)->names('admin.stops');
    });
    Route::resource('contacts', ContactController::class)->names('admin.contacts');
    // Add other admin routes here
});

require __DIR__.'/auth.php';
