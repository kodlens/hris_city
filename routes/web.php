<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

use App\Models\Appointment;
use App\Models\User;
use App\Models\DentistSchedule;




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
    return view('welcome');
});



//open for combo box
Route::get('/get-open-learning-dev-types', [App\Http\Controllers\OpenController::class, 'loadLearningDevTypes']);
Route::get('/get-open-specializations', [App\Http\Controllers\OpenController::class, 'loadSpecializations']);



Auth::routes([
    'login' => 'false'
]);

Route::get('/load-user', function(){
    if(Auth::check()){
        return Auth::user();
    }
});




Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sign-up', [App\Http\Controllers\SignUpController::class, 'index']);
Route::post('/sign-up', [App\Http\Controllers\SignUpController::class, 'store']);


Route::get('/get-user/{id}', [App\Http\Controllers\OpenUserController::class, 'getUser']);




//ADDRESS
Route::get('/load-provinces', [App\Http\Controllers\AddressController::class, 'loadProvinces']);
Route::get('/load-cities', [App\Http\Controllers\AddressController::class, 'loadCities']);
Route::get('/load-barangays', [App\Http\Controllers\AddressController::class, 'loadBarangays']);


/*     ADMINSITRATOR          */
Route::resource('/admin-home', App\Http\Controllers\Administrator\AdminHomeController::class);

Route::resource('/users', App\Http\Controllers\Administrator\UserController::class);
Route::get('/get-users', [App\Http\Controllers\Administrator\UserController::class, 'getUsers']);
Route::get('/get-user-offices', [App\Http\Controllers\Administrator\UserController::class, 'getOffices']);
Route::post('/user-reset-password/{id}', [App\Http\Controllers\Administrator\UserController::class, 'resetPassword']);
Route::post('/other-info-store/{userid}', [App\Http\Controllers\Administrator\UserController::class, 'storeOtherInfo']);



Route::resource('/learning-dev', App\Http\Controllers\LearningDevelopmentTypeController::class);
Route::get('/get-learning-dev', [App\Http\Controllers\LearningDevelopmentTypeController::class, 'getLearningDevelopmentTypes']);

Route::resource('/specialization', App\Http\Controllers\Administrator\SpecializationController::class);
Route::get('/get-specialization', [App\Http\Controllers\Administrator\SpecializationController::class, 'getSpecialization']);


/*     ADMINSITRATOR          */


// USER ROUTES
Route::get('/pending-page', function(){
    return view('faculty.pending-page');
});

Route::post('/reset-password',[App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword']);;




//USER MIDDLEWARE
Route::middleware(['auth', 'user'])->group(function(){
        
    Route::resource('/home', App\Http\Controllers\User\UserHomeController::class);
    //Route::post('/seminar-im-in', [App\Http\Controllers\User\UserHomeController::class, 'imIn']);

    Route::resource('/personal-data-sheet', App\Http\Controllers\User\UserPDSController::class);
    Route::post('/personal-data-sheet-update/{id}', [App\Http\Controllers\User\UserPDSController::class, 'update']);

    Route::resource('/educational-backgrounds', App\Http\Controllers\User\UserEducationalBackgroundController::class);
    Route::resource('/children', App\Http\Controllers\User\UserChildController::class);
    Route::resource('/eligibilities', App\Http\Controllers\User\UserCSEController::class);
    Route::resource('/work-experiences', App\Http\Controllers\User\UserWorkExperienceController::class);
    Route::resource('/learning-developments', App\Http\Controllers\User\UserLearningDevelopmentController::class);
    Route::resource('/other-informations', App\Http\Controllers\User\UserOtherInformationController::class);

    Route::resource('/trainings-interventions', App\Http\Controllers\User\TrainingInterventionController::class);
    Route::post('/trainings-interventions-update/{id}', [App\Http\Controllers\User\TrainingInterventionController::class, 'update']);

    Route::get('/get-learning-trainings', [App\Http\Controllers\User\TrainingInterventionController::class, 'getLearningTrainings']);

    //certificates
    Route::post('/upload-certificates/{id}', [App\Http\Controllers\User\CertificateController::class, 'upload']);
    Route::delete('/remove-certificate/{id}', [App\Http\Controllers\User\CertificateController::class, 'delete']);


    //PDS API need user id to generate DPS
    Route::get('/display-pds/{id}', [App\Http\Controllers\PDSController::class, 'index']);


});

Route::get('/session', function(){
    return Session::all();
});


Route::get('/before', function(){
    //return Session::all();


    $beforeDay = date('Y-m-d H:i', strtotime('+24 hour', strtotime(date('Y-m-d H:i'))));

    $data = \DB::table('appointments')
        ->where('appoint_date', date('Y-m-d', strtotime($beforeDay)))
        ->where('appoint_time', date('H:i', strtotime($beforeDay)))
        ->where('is_notify', 0)
        ->get();

    foreach($data as $i){

        $user = User::find($i->user_id);

        $msg = 'Hi '.$user->lname . ', ' . $user->fname . ', this is just a reminder that you have an appointment tomorrow. Your ref no. is: ' . $i->qr_code . '.';
        try{
            Http::withHeaders([
                'Content-Type' => 'text/plain'
            ])->post('http://'. env('IP_SMS_GATEWAY') .'/services/api/messaging?Message='.$msg.'&To='.$user->contact_no.'&Slot=1', []);
        }catch(Exception $e){} //just hide the error

        $appoint = Appointment::find($i->appointment_id);
        $appoint->is_notify = 1;
        $appoint->save();
    }

    //$beforeDay = date($today, strtotime('-1 day'));
    return $data;
});




Route::get('/collect', function(){
    return $collection = collect([1, 2, 3]);
});


Route::get('/applogout', function(Request $req){
    \Auth::logout();
    $req->session()->invalidate();
    $req->session()->regenerateToken();


});
