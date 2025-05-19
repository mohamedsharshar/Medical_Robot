<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RobotController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit')->middleware('auth');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
Route::post('/profile/update-image', [AuthController::class, 'updateProfileImage'])->name('profile.updateImage')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/robot', [RobotController::class, 'dashboard'])->middleware('auth')->name('robot.dashboard');
Route::post('/robot/command', [RobotController::class, 'sendCommand'])->middleware('auth');
Route::get('/robot/live', [RobotController::class, 'liveData'])->middleware('auth');

Route::resource('patients', PatientController::class)->middleware('auth');
