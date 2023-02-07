<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


use App\Models\User;
use App\Models\Category;
use App\Models\Jobtype;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // if(Auth::check()){
    //     $user = Auth::user();
    //     return view('welcome')
    //         ->with('user', $user->only(['lname', 'fname', 'mname', 'suffix', 'role', 'remark', 'office_id']));
    // }
    return view('welcome');
});

Route::get('/get-jobs-hiring', [App\Http\Controllers\JobHiringController::class, 'getJobsHiring']);
Route::get('/get-open-skills', [App\Http\Controllers\OpenSkillController::class, 'getOpenSkills']);


Auth::routes([
    'login' => true,
    'verify' => true
]);


Route::get('/load-user', function(){
    if(Auth::check()){
        return Auth::user();
    }
});



Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/sample',[App\Http\Controllers\SampleController::class,'index']);

//Route::get('/home', [App\Http\Controllers\Employee\HomeController::class, 'index'])->name('home');

Route::get('/sign-up', [App\Http\Controllers\User\SignUpController::class, 'index']);
Route::post('/sign-up', [App\Http\Controllers\User\SignUpController::class, 'store']);


Route::get('/get-user/{id}', [App\Http\Controllers\OpenUserController::class, 'getUser']);
Route::get('/get-logged-user', [App\Http\Controllers\OpenUserController::class, 'getLoggedUser']);


Route::get('/get-open-categories', [App\Http\Controllers\OpenCategoryController::class, 'getCategories']);




//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);




// ------------EMPLOYEE-----------------------
Route::get('/employee/dashboard', [App\Http\Controllers\Employee\EmployeeDashboardController::class, 'index']);
Route::get('/get-recommended-jobs', [App\Http\Controllers\Employee\EmployeeDashboardController::class, 'getRecommendedJob']);


Route::get('/employee/profile', [App\Http\Controllers\Employee\EmployeeProfileController::class, 'index']);
Route::post('/employee/profile-update/{id}', [App\Http\Controllers\Employee\EmployeeProfileController::class, 'update']);
Route::post('/employee/change-password', [App\Http\Controllers\Employee\EmployeeProfileController::class, 'changePassword']);

Route::get('/employee/get-user/{id}', [App\Http\Controllers\Employee\EmployeeProfileController::class, 'getUser']);


Route::get('/employee/my-applications', [App\Http\Controllers\Employee\EmployeeMyApplicationController::class, 'index']);
Route::get('/employee/get-my-applications', [App\Http\Controllers\Employee\EmployeeMyApplicationController::class, 'getMyApplications']);


Route::post('/employee/submit-rating', [App\Http\Controllers\Employee\CompanyRatingController::class, 'store']);
Route::get('/employee/get-employee-rating/{user_id}', [App\Http\Controllers\Employee\EmployeeRatingController::class, 'getEmployeeRating']);

Route::get('/employee/get-my-rating', [App\Http\Controllers\Employee\EmployeeRatingController::class, 'getMyRating']);





// ------------EMPLOYEE-----------------------


//----------APPLY NOW API-----------------------

Route::get('/apply-now/{id}', [App\Http\Controllers\ApplyNowController::class, 'applyNow']);
Route::post('/apply-now-submit', [App\Http\Controllers\ApplyNowController::class, 'store']);

//----------------------------------------------


/*     ADMINSITRATOR          */

Route::resource('/admin/home', App\Http\Controllers\Administrator\AdminHomeController::class);


Route::resource('/admin/job-types', App\Http\Controllers\Administrator\JobTypeController::class);
Route::get('/admin/get-job-types', [App\Http\Controllers\Administrator\JobTypeController::class, 'getJobTypes']);


Route::resource('/admin/categories', App\Http\Controllers\Administrator\CategoryController::class);
Route::get('/admin/get-categories', [App\Http\Controllers\Administrator\CategoryController::class, 'getCategories']);

Route::resource('/admin/qualifications', App\Http\Controllers\Administrator\QualificationController::class);
Route::get('/admin/get-qualifications', [App\Http\Controllers\Administrator\QualificationController::class, 'getQualifications']);

Route::resource('/admin/skills', App\Http\Controllers\Administrator\SkillController::class);
Route::get('/admin/get-skills', [App\Http\Controllers\Administrator\SkillController::class, 'getSkills']);



Route::resource('/admin/users', App\Http\Controllers\Administrator\UserController::class);
Route::get('/admin/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);
Route::post('/admin/reset-password/{id}', [App\Http\Controllers\Administrator\UserController::class, 'resetPassword']);

//REPORT Side for Administrator
Route::get('/hired-list', [App\Http\Controllers\Administrator\Report\ReportHiredController::class, 'index']);
Route::get('/get-applicant-report', [App\Http\Controllers\Administrator\Report\ReportHiredController::class, 'getApplicantReport']);


// EMPLOYER ROUTES
Route::resource('/employer/signup', App\Http\Controllers\Employer\EmployerSignUpController::class);

Route::resource('/employer/dashboard', App\Http\Controllers\Employer\EmployerDashboardController::class);

//JOB POST (FEEDS)
Route::get('/employer/company-job-post/{cid}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'index']);
Route::post('/employer/company-job-post/{cid}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'store']);
Route::put('/employer/company-job-update/{id}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'update']);
Route::delete('/employer/company-job-post-delete/{id}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'destroy']);
Route::delete('/employer/job-post-skill-delete/{skill}/{job_post_id}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'deleteSkill']); //delete skill using skill

Route::get('/employer/get-job-post/{id}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'show']);
Route::get('/employer/get-job-posts', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'getJobPosts']); //get job post per company

Route::post('/employer/job-post-hide/{id}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'hideJobPost']); //get job post per company
Route::post('/employer/job-post-publish/{id}', [App\Http\Controllers\Employer\EmployerJobPostController::class, 'publishJobPost']); //get job post per company


Route::get('/employer/applicants/{job_post_id}', [App\Http\Controllers\Employer\EmployerApplicantController::class, 'index']); //get job post per company
Route::get('/employer/get-applicants/{job_post_id}', [App\Http\Controllers\Employer\EmployerApplicantController::class, 'getApplicants']); //get job post per company
Route::post('/employer/accept-applicant/{applicant_id}', [App\Http\Controllers\Employer\EmployerApplicantController::class, 'acceptApplicant']); //get job post per company
Route::post('/employer/cancel-applicant/{applicant_id}', [App\Http\Controllers\Employer\EmployerApplicantController::class, 'cancelApplicant']); //get job post per company

Route::get('/employer/applicant-profile/{id}', [App\Http\Controllers\Employer\ApplicantProfileController::class, 'index']); //get job post per company


Route::get('/employer/job-post-list', [App\Http\Controllers\Employer\ApplicantListController::class, 'index']);
Route::get('/employer/get-job-post-list', [App\Http\Controllers\Employer\ApplicantListController::class, 'getJobPostList']);
Route::post('/employer/applicant-list-end-contract/{id}', [App\Http\Controllers\Employer\ApplicantListController::class, 'endContract']);



Route::get('/employer/display-resume/{applicant_id}', [App\Http\Controllers\Employer\ViewResumeController::class, 'viewResume']); //get job post per company
Route::get('/employer/get-applicant-info/{applicant_id}', [App\Http\Controllers\Employer\ViewResumeController::class, 'getApplicantInfo']); //get job post per company
Route::get('/employer/get-applicant-info/{applicant_id}', [App\Http\Controllers\Employer\ViewResumeController::class, 'getApplicantInfo']); //get job post per company


Route::get('/employer/get-my-companies', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'getMyCompanies']);

//rate the employee
Route::post('/employer/rate-employee', [App\Http\Controllers\Employer\EmployerRateEmployeeController::class, 'store']); //get job post per company


Route::get('/employer/company-add-edit', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'create']);
Route::post('/employer/company-add-edit', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'store']);
Route::put('/employer/company-add-edit/{id}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'update']);
Route::get('/employer/company-add-edit/{id}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'edit']);
Route::get('/employer/company-show/{cid}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'show']);
Route::delete('/employer/company-delete/{id}', [App\Http\Controllers\Employer\EmployerCompanyController::class, 'destroy']);



//Employer Type
Route::get('/employer/get-employer-types', [App\Http\Controllers\Employer\EmployerTypeController::class, 'getEmployerTypes']);



// ------------------------------------------------------------------



Route::get('/session', function(){
    return Session::all();
});



Route::get('/collect', function(){
    return $collection = collect([1, 2, 3]);
});


Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();


});
