<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CornDetectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Login & logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::prefix('corn-detection')->group(function () {
    Route::get('/', [CornDetectionController::class, 'index'])->name('corn.index');
    Route::post('/detect', [CornDetectionController::class, 'detect'])->name('corn.detect');
    Route::get('/metrics', [CornDetectionController::class, 'metrics'])->name('corn.metrics');
    Route::get('/chart/{filename}', [CornDetectionController::class, 'showChart'])->name('corn.chart');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
