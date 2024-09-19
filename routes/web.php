<?php

use App\Http\Controllers\Auth\CompanyRegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('register', [RegisterController::class, 'showRoleSelection'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('register/{role}', [RegisterController::class, 'showRegistrationForm']);
Route::post('register/{role}', [RegisterController::class, 'handleRegistration']);
Route::get('email/verify/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->name('verification.verify');