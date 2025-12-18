<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::get('/test', function () {
    return view('test');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Guest Routes
Route::middleware(['auth', 'role:Guest'])->group(function () {
    Route::get('/guest/jobs', function () {
        return view('guest.jobs');
    })->name('guest.jobs');

    Route::get('/guest/apply', [PelamarController::class, 'create'])->name('guest.apply');
    Route::post('/guest/apply', [PelamarController::class, 'store'])->name('pelamar.store');
});

// Staff Routes
Route::middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('/staff/dashboard', [PelamarController::class, 'staffDashboard'])->name('staff.dashboard');
    Route::get('/staff/pelamar/{pelamar}', [PelamarController::class, 'show'])->name('staff.pelamar.show');
    Route::put('/staff/pelamar/{pelamar}', [PelamarController::class, 'update'])->name('staff.pelamar.update');
});

// Admin Routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/pelamar', PelamarController::class, ['as' => 'admin']);
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

