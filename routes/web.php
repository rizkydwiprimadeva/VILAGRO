<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CornDetectionController;
use App\Http\Controllers\DiseaseReportController;
use App\Http\Controllers\FarmMapController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/scanner', [HomeController::class, 'scanner'])->name('scanner');
Route::post('/scanner/detect', [CornDetectionController::class, 'detect'])
    ->middleware(['auth', 'throttle:10,1'])
    ->name('corn.detect');
Route::get('/map', [FarmMapController::class, 'index'])->name('farm-map');
Route::get('/encyclopedia', [HomeController::class, 'encyclopedia'])->name('encyclopedia');
Route::get('/guide', [HomeController::class, 'guide'])->name('guide');
Route::get('/consultation', [HomeController::class, 'consultation'])->name('consultation');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::middleware('auth')->group(function () {
    Route::get('/scan-history', [DiseaseReportController::class, 'index'])
        ->name('scan-history.index');
    Route::post('/farm-location', [FarmMapController::class, 'updateLocation'])
        ->name('farm-location.update');
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');
});

// Login & logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');