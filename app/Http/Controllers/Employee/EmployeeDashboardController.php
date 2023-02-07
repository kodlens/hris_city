<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('employee');
        $this->middleware('verified');

    }

    public function index(){

        $id = Auth::user()->user_id;

        $user = User::where('user_id', $id)
            ->with(['categories'])->first();

        return view('employee.employee-dashboard')
            ->with('user', $user); //blade.php
    }

    public function getRecommendedJob(Request $req){
        $categories = json_decode($req->categories);

        $data = JobPost::with(['category', 'company', 'jobtype']);

        $data->whereHas('category', function ($q) use ($categories){
            $q->whereIn('category', $categories);
        });

        $data->orderBy('job_post_id', 'desc');

        return $data->get();
    }



}
