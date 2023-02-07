<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;

class EmployerApplicantController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');

    }
    
    public function index($job_post_id){

        return view('employer.applicants')
            ->with('job_post_id', $job_post_id);
    }

    public function getApplicants($job_post_id){

        $data = Applicant::with(['applicant'])
            ->addSelect(['total_rating' => function ($q){
                $q->selectRaw('sum(rating)')
                ->from('employee_ratings')
                ->whereColumn('user_id', 'applicants.user_id');
            }])
            ->addSelect(['total_raters' => function ($q){
                $q->selectRaw('count(*)')
                ->from('employee_ratings')
                ->whereColumn('user_id', 'applicants.user_id');
            }])
            ->selectRaw('(select(total_rating) / (select count(*) from employee_ratings where user_id = applicants.user_id)) as user_total_rating')
            ->where('job_post_id', $job_post_id)
            
            ->get();

        return $data;
    }

    public function acceptApplicant($appId){
        $data = Applicant::find($appId);
        $data->is_accepted = 1;
        $data->date_hired = date("Y-m-d");
        $data->save();

        return response()->json([
            'status' => 'accepted'
        ], 200);
    }

    public function cancelApplicant($appId){
        $data = Applicant::find($appId);
        $data->is_accepted = 0;
        $data->save();

        return response()->json([
            'status' => 'canceled'
        ], 200);
    }


}