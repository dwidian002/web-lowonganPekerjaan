<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FieldOfWorkController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\TypeCompanyController;
use App\Http\Controllers\Applicant\ApplyJobController;
use App\Http\Controllers\Applicant\CompanyController;
use App\Http\Controllers\Applicant\EducationController;
use App\Http\Controllers\Applicant\ExperienceController;
use App\Http\Controllers\Applicant\JobController;
use App\Http\Controllers\Applicant\ProfileController;
use App\Http\Controllers\Applicant\SkillController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Company\ApplicationController;
use App\Http\Controllers\Company\JobPostingController;
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;
use App\Http\Controllers\Company\RecruitmentStatsController;
use App\Http\Controllers\ProfileController as ControllersProfileController;
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
    Route::get('/job-posting/close/{id}', [JobPostingController::class, 'close'])->name('job-posting.close');
    Route::get('/job-posting/open/{id}', [JobPostingController::class, 'open'])->name('job-posting.open');
    Route::delete('/job-posting/{id}/delete', [JobPostingController::class, 'delete'])->name('job-posting.delete');


    Route::get('/application', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/applications/{id}/detail', [ApplicationController::class, 'detail'])->name('company.application.detail');
    Route::get('/applications/{id}/status/{status}', [ApplicationController::class, 'updateStatus'])->name('application.updateStatus');
    Route::post('/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('applications.schedule-interview');
    Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
    Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');

    Route::get('/company-profile', [CompanyProfileController::class, 'index'])->name('profile-company');
    Route::get('/company-profile/edit/{id}', [CompanyProfileController::class, 'edit'])->name('profile-company.edit');
    Route::post('/company-profile/update', [CompanyProfileController::class, 'update'])->name('profile-company.update');
});

Route::get('/list-company', [CompanyController::class, 'list'])->name('list.company');
Route::get('/company/{id}', [CompanyController::class, 'detail'])->name('company.detail');

Route::get('/job-postings', [JobController::class, 'index'])->name('job-postings.all');



Route::middleware(['auth', 'applicant'])->group(function () {


    Route::get('/my-profile', [ProfileController::class, 'index'])->name('profile-applicant');
    Route::get('/my-profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile-applicant.edit');
    Route::post('/my-profile/update', [ProfileController::class, 'update'])->name('profile-applicant.update');
    Route::get('/my-profile/more-info', [ProfileController::class, 'information'])->name('profile-more-info');

    Route::post('/my-profile/education/store', [EducationController::class, 'store'])->name('education.store');
    Route::post('/my-profile/education/update/{id}', [EducationController::class, 'update'])->name('education.update');
    Route::delete('/my-profile/education/delete/{id}', [EducationController::class, 'delete'])->name('education.delete');

    Route::post('/my-profile/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
    Route::post('/my-profile/experience/update/{id}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::delete('/my-profile/experience/delete/{id}', [ExperienceController::class, 'delete'])->name('experience.delete');

    Route::post('/my-profile/skill/store', [SkillController::class, 'store'])->name('skill.store');
    Route::post('/my-profile/skill/update/{id}', [SkillController::class, 'update'])->name('skill.update');
    Route::delete('/my-profile/skill/delete/{id}', [SkillController::class, 'delete'])->name('skill.delete');

    Route::get('/my-application', [ProfileController::class, 'myApplication'])->name('application.my-application');
    Route::get('/download-resume/{application}', [ProfileController::class, 'downloadResume'])->name('download.resume');

    Route::get('/job-detail/{id}', [JobController::class, 'detail'])->name('job.detail');

    Route::get('/apply-job/{id}', [ApplyJobController::class, 'index'])->name('form.apply');
    Route::post('/apply-job', [ApplyJobController::class, 'store'])->name('store.apply');

    // Route::get('/company/{id}', [CompanyController::class, 'detail'])->name('company.detail');
});

// Route::group(['middleware' => 'auth:user'], function(){
Route::middleware(['auth', 'admin'])->group(function () {

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






// Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');

// });

//Route untuk mengisi education, skills dan exerience applicant

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


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
