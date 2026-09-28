<?php

use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminMatchController;    
use App\Http\Controllers\Admin\AdminStatisticController;
use App\Http\Controllers\Admin\AdminTeamController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TeamPlayerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - WIKCUP (Wikrama Cup Basketball)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jadwal', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/hasil', [ResultController::class, 'index'])->name('result.index');
Route::get('/hasil/{id}', [ResultController::class, 'show'])->name('result.show');
Route::get('/tim', [TeamPlayerController::class, 'index'])->name('team.index');
Route::get('/tim/{id}', [TeamPlayerController::class, 'showTeam'])->name('team.show');
Route::get('/pemain/{id}', [TeamPlayerController::class, 'showPlayer'])->name('player.show');
Route::get('/statistik', [StatisticController::class, 'index'])->name('statistic.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// ==========================================
// 2. AUTHENTICATION ROUTES
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// 3. PEMAIN (PLAYER) PROTECTED ROUTES
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profil', [PlayerProfileController::class, 'show'])->name('player.profile');
    Route::put('/profil', [PlayerProfileController::class, 'update'])->name('player.profile.update');
});

// ==========================================
// 4. ADMIN DASHBOARD & CRUD ROUTES
// ==========================================
Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('teams', AdminTeamController::class);
    Route::resource('matches', AdminMatchController::class);
    Route::resource('statistics', AdminStatisticController::class);
    Route::resource('galleries', AdminGalleryController::class);
});
