<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Redirect root to students directory (or login if unauthenticated)
Route::get('/', function () {
    return redirect()->route('students.index');
});

// Authentication Routes
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Resource Routes (Students & Departments CRUD)
Route::middleware('auth')->group(function (): void {
    Route::resource('students', StudentController::class);
    Route::resource('departments', DepartmentController::class)->except(['show']);
});
