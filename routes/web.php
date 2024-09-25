<?php

use App\Http\Controllers\Auth\ApplicantRegisterController;
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




// Route untuk register applicant
Route::get('register/applicant', [RegisterController::class, 'showApplicantRegisterForm'])->name('register.applicant');
Route::post('register/applicant/submit', [RegisterController::class, 'registerApplicant'])->name('register.applicant.submit');

//route untuk register company
Route::get('register/company', [RegisterController::class, 'showCompanyRegisterForm'])->name('register.company');
Route::post('register/company/submit', [RegisterController::class, 'registerCompany'])->name('register.company.submit');

// Routes untuk verifikasi email
Route::get('/verify-ur-email', [RegisterController::class, 'verify'])->name('verification.notice');
Route::get('/email/verify/{token}', [VerificationController::class, 'verify'])->name('email.verify');

//Route untuk mengisi education, skills dan exerience applicant
Route::get('/profile/education-skills-experience/{token}', [ProfileController::class, 'exsForm'])->name('exs.form');
Route::post('/profile/education-skills-experience/{token}', [ProfileController::class,'storeExs'])->name('exs.store');
