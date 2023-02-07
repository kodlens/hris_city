<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployeeRating;


class EmployerRateEmployeeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');

    }

    public function store(Request $req){
 
        $exist = EmployeeRating::where('user_id', $req->user_id)
            ->where('job_post_id', $req->job_post_id)
            ->where('applicant_id', $req->applicant_id)
            ->exists();

        if($exist){
            return response()->json([
                'status' => 'exist'
            ], 422);
        }
        
        EmployeeRating::create([
            'user_id' => $req->user_id,
            'job_post_id' => $req->job_post_id,
            'applicant_id' => $req->applicant_id,
            'rating' => $req->rating
        ]);

        return response()->json([
            'status' => 'submitted'
        ], 200);
    }


}
