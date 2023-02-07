<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Applicant;

class EmployeeMyApplicationController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function index(){
        return view('employee.my-application');
    }

    public function getMyApplications(){
        $user = Auth::user();

        $data = Applicant::with(['job_post'])
            ->where('user_id', $user->user_id)
            ->get();

        return $data;
    }
}
