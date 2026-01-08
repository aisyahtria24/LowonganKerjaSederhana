<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Staff\StaffJobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/navigation', function () {
    return view('navigation');
});

Route::get('/test', function () {
    return view('test');
});

// Authentication Routes
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register')->name('register.post');
});

// Guest Routes - Public job listings and applications
Route::prefix('guest')->name('guest.')->group(function () {
    Route::get('jobs', [JobController::class, 'index'])->name('jobs');
    Route::middleware(['auth', 'role:Guest'])->group(function () {
        Route::get('apply', [PelamarController::class, 'create'])->name('apply');
        Route::post('apply', [PelamarController::class, 'store'])->name('apply.store');
    });
});

// Staff Routes - Job management and applicant reviews
Route::prefix('staff')->name('staff.')->middleware(['auth', 'role:Staff'])->group(function () {
    Route::get('dashboard', [PelamarController::class, 'staffDashboard'])->name('dashboard');
    Route::resource('jobs', StaffJobController::class);
    Route::get('pelamar/{pelamar}', [PelamarController::class, 'show'])->name('pelamar.show');
    Route::put('pelamar/{pelamar}', [PelamarController::class, 'update'])->name('pelamar.update');
});

// Admin Routes - Full system management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    // Job Management
    Route::resource('jobs', AdminJobController::class);

    // Category Management
    Route::controller(AdminJobController::class)->group(function () {
        Route::get('categories', 'categoriesIndex')->name('categories.index');
        Route::get('categories/create', 'categoriesCreate')->name('categories.create');
        Route::post('categories', 'categoriesStore')->name('categories.store');
        Route::get('categories/{id}/edit', 'categoriesEdit')->name('categories.edit');
        Route::put('categories/{id}', 'categoriesUpdate')->name('categories.update');
        Route::delete('categories/{id}', 'categoriesDestroy')->name('categories.destroy');
    });

    // Applicant Management
    Route::resource('pelamar', PelamarController::class);
});

// Dashboard Route (redirects based on user role)
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

