<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FieldOfWorkController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\TypeCompanyController;
use App\Http\Controllers\Applicant\CompanyController;
use App\Http\Controllers\Applicant\JobController;
use App\Http\Controllers\Applicant\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\JobPostingController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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

Route::get('/login', [LoginController::class, 'index'])->name('auth.index');
Route::post('/login', [LoginController::class, 'login'])->name('auth.verify');

// Email Verification Routes
Route::get('/verify-email', [LoginController::class, 'verifyEmail'])->name('verify.email');
Route::get('/email/verify', [RegisterController::class, 'verify'])->name('verification.notice');
Route::post('/email/resend', [LoginController::class, 'resendVerification'])->name('verification.resend');

// Registration Routes
Route::get('register/applicant', [RegisterController::class, 'showApplicantRegisterForm'])->name('register.applicant');
Route::post('register/applicant/submit', [RegisterController::class, 'registerApplicant'])->name('register.applicant.submit');

Route::get('/profile/education-skills-experience/', [ProfileController::class, 'exsForm'])->name('exs.form');
Route::post('/profile/education-skills-experience/', [ProfileController::class, 'storeExs'])->name('exs.store');

Route::get('register/company', [RegisterController::class, 'showCompanyRegisterForm'])->name('register.company');
Route::post('register/company/submit', [RegisterController::class, 'registerCompany'])->name('register.company.submit');


Route::get('home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'company'])->group(function () {


    Route::get('/job-posting', [JobPostingController::class, 'index'])->name('job-posting.index');
    Route::get('/job-posting/detail/{id}', [JobPostingController::class, 'detail'])->name('job-posting.show');
    Route::get('/job-posting/add', [JobPostingController::class, 'add'])->name('job-posting.add');
    Route::post('/job-posting/store', [JobPostingController::class, 'store'])->name('job-posting.store');
    Route::get('/job-posting/edit/{id}', [JobPostingController::class, 'edit'])->name('job-posting.edit');
    Route::post('/job-posting/update/{id}', [JobPostingController::class, 'update'])->name('job-posting.update');
    Route::get('/job-posting/delete{id}', [JobPostingController::class, 'delete'])->name('job-posting.delete');


});

Route::middleware(['auth', 'applicant'])->group(function () {
    
    Route::get('/list-company', [CompanyController::class, 'list'])->name('list.company');
    Route::get('/company/{id}', [CompanyController::class, 'detail'])->name('company.detail');
    Route::get('/all-job', [JobController::class, 'index'])->name('all.job');
    // Route::get('/my-profile', [ProfileController::class, 'index'])->name('my.profile');
    // Route::get('/list-company', [CompanyController::class, 'list'])->name('list.company');
    // Route::get('/company/{id}', [CompanyController::class, 'detail'])->name('company.detail');
});

// Route::group(['middleware' => 'auth:user'], function(){
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'admin'])->name('indexAdmin');

        Route::get('/industry', [IndustryController::class, 'index'])->name('industry.index');
        Route::get('/industry/add', [IndustryController::class, 'add'])->name('industry.add');
        Route::post('/industry/store', [IndustryController::class, 'store'])->name('industry.store');
        Route::get('/industry/edit/{id}', [IndustryController::class, 'edit'])->name('industry.edit');
        Route::post('/industry/update', [IndustryController::class, 'update'])->name('industry.update');
        Route::get('/industry/delete{id}', [IndustryController::class, 'delete'])->name('industry.delete');

        Route::get('/type-company', [TypeCompanyController::class, 'index'])->name('type-company.index');
        Route::get('/type-company/add', [TypeCompanyController::class, 'add'])->name('type-company.add');
        Route::post('/type-company/store', [TypeCompanyController::class, 'store'])->name('type-company.store');
        Route::get('/type-company/edit/{id}', [TypeCompanyController::class, 'edit'])->name('type-company.edit');
        Route::post('/type-company/update', [TypeCompanyController::class, 'update'])->name('type-company.update');
        Route::get('/type-company/delete{id}', [TypeCompanyController::class, 'delete'])->name('type-company.delete');

        Route::get('/location', [LocationController::class, 'index'])->name('location.index');
        Route::get('/location/add', [LocationController::class, 'add'])->name('location.add');
        Route::post('/location/store', [LocationController::class, 'store'])->name('location.store');
        Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
        Route::post('/location/update', [LocationController::class, 'update'])->name('location.update');
        Route::get('/location/delete{id}', [LocationController::class, 'delete'])->name('location.delete');

        Route::get('/field-work', [FieldOfWorkController::class, 'index'])->name('field-work.index');
        Route::get('/field-work/add', [FieldOfWorkController::class, 'add'])->name('field-work.add');
        Route::post('/field-work/store', [FieldOfWorkController::class, 'store'])->name('field-work.store');
        Route::get('/field-work/edit/{id}', [FieldOfWorkController::class, 'edit'])->name('field-work.edit');
        Route::post('/field-work/update', [FieldOfWorkController::class, 'update'])->name('field-work.update');
        Route::get('/field-work/delete{id}', [FieldOfWorkController::class, 'delete'])->name('field-work.delete');


        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/delete{id}', [CategoryController::class, 'delete'])->name('category.delete');


        Route::get('/company', [AdminCompanyController::class, 'index'])->name('company.index');
        Route::get('/company/add', [AdminCompanyController::class, 'add'])->name('company.add');
        Route::post('/company/store', [AdminCompanyController::class, 'store'])->name('company.store');
        Route::get('/company/edit/{id}', [AdminCompanyController::class, 'edit'])->name('company.edit');
        Route::post('/company/update', [AdminCompanyController::class, 'update'])->name('company.update');
        Route::get('/company/delete{id}', [AdminCompanyController::class, 'delete'])->name('company.delete');
    });
});





// Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');

// });

//Route untuk mengisi education, skills dan exerience applicant

Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout');


Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/logos' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage');
