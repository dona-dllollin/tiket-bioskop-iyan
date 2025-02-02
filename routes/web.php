<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieScheduleController;
use App\Http\Controllers\UserController;
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
// Route untuk homepage
Route::get('/', function () {
    // return redirect('/login');
    return view('welcome');

});

// Route untuk autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route untuk Manager
    Route::middleware('auth.manager')->prefix('manager')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'managerDashboard'])->name('manager.dashboard');
        Route::resource('movies', MovieController::class);
        Route::resource('schedules', MovieScheduleController::class);
        Route::resource('users', UserController::class);
    });

    // Route untuk Admin
    Route::middleware('auth.admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
        Route::resource('bookings', BookingController::class);
        Route::get('/get-schedules/{movie}', [BookingController::class, 'getSchedules'])->name('get.schedules');
        Route::get('/bookings/{booking}/print', [BookingController::class, 'printTicket'])->name('bookings.print');
    });
});



