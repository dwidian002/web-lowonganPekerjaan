<?php

use App\Http\Controllers\Auth\CompanyRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('home', [HomeController::class, 'index'])->name('indexUser');
Route::get('admin', [HomeController::class, 'admin'])->name('indexAdmin');


Route::get('/login', [LoginController::class, 'index'])->name('auth.index');
Route::post('/login', [LoginController::class, 'verify'])->name('auth.verify');


// Rute untuk form registrasi
Route::get('register', [RegisterController::class, 'showRegistrationForm']);
Route::post('register/proses', [RegisterController::class, 'register'])->name('register.proses');

// Routes untuk verifikasi email
Route::get('/verify-ur-email', [RegisterController::class, 'verify'])->name('verification.notice');
Route::get('/email/verify/{token}', [VerificationController::class, 'verify'])->name('email.verify');

// Route untuk verifikasi email dan melengkapi profil company
Route::get('/profile/complete-company/{token}', [ProfileController::class, 'completeCompanyProfile'])->name('profile.complete-company');
Route::post('/profile/complete-company/{token}', [ProfileController::class, 'storeCompanyProfile'])->name('profile.store-company');

// Route untuk verifikasi email dan melengkapi profil applicant
Route::get('/profile/complete-applicant/{token}', [ProfileController::class, 'completeApplicantProfile'])->name('profile.complete-applicant');
Route::post('/profile/complete-applicant/{token}', [ProfileController::class, 'storeApplicantProfile'])->name('profile.store-applicant');
