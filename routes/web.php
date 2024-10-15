<?php

use App\Http\Controllers\Auth\ApplicantRegisterController;
use App\Http\Controllers\Auth\CompanyRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerificationController;
use App\Models\Company;
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


Route::get('/login', [LoginController::class, 'index'])->name('auth.index');
Route::post('/login', [LoginController::class, 'verify'])->name('auth.verify');


// Rute untuk form registrasi


// Route::group(['middleware' => 'auth:user'], function(){
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('indexAdmin');

        Route::get('/location', [LocationController::class, 'index'])->name('location.index');
        Route::get('/location/add', [LocationController::class, 'add'])->name('location.add');
        Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
        Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
        Route::post('/location/update', [LocationController::class, 'update'])->name('location.update');
        Route::get('/location/delete{id}', [LocationController::class, 'delete'])->name('location.delete');


        Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
        Route::get('/company/add', [CompanyController::class, 'add'])->name('company.add');
        Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
        Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
        Route::post('/location/update', [LocationController::class, 'update'])->name('location.update');
        Route::get('/location/delete{id}', [LocationController::class, 'delete'])->name('location.delete');



        Route::middleware(['auth', 'company'])->group(function () {

            Route::get('/all-job', [JobController::class, 'index'])->name('all.job');
        });

        Route::middleware(['auth', 'applicant'])->group(function () {
            Route::get('/all-job', [JobController::class, 'index'])->name('all.job');
            Route::get('/my-profile', [ProfileController::class, 'index'])->name('my.profile');
        });
    });
});


// Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');

// });

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
Route::get('/profile/education-skills-experience/', [ProfileController::class, 'exsForm'])->name('exs.form');
Route::post('/profile/education-skills-experience/', [ProfileController::class, 'storeExs'])->name('exs.store');

Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout');
