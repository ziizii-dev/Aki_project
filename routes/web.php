<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\GoogleController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
Route::post('/inquiry', [InquiryController::class, 'submit'])->name('inquiry.submit');

// User login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Admin login routes
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//Google login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/export-csv', [DashboardController::class, 'exportCSV'])->name('dashboard.exportCSV'); // CSV export for users
Route::get('/register', [DashboardController::class, 'create'])->name('register');
Route::post('/register', [DashboardController::class, 'store'])->name('register.store');
Route::resource('dashboard', DashboardController::class);


Route::middleware(['auth', AdminMiddleware::class])->get('/user', [UserController::class, 'index'])->name('user.index');
Route::middleware(['auth', AdminMiddleware::class])->get('/user/register', [UserController::class, 'create'])->name('user.register');
Route::middleware(['auth', AdminMiddleware::class])->post('/user/register', [UserController::class, 'store'])->name('user.register.store');
Route::middleware(['auth', AdminMiddleware::class])->delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');


