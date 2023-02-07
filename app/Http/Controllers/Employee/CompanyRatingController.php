<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompanyRating;

class CompanyRatingController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('employee');
    }

    public function store(Request $req){

        $exist = CompanyRating::where('company_id', $req->company_id)
            ->where('user_id', $req->user_id)
            ->where('job_post_id', $req->job_post_id)
            ->exists();
        if($exist){
            return response()->json([
                'status' => 'exist'
            ], 422);
        }

        CompanyRating::create([
            'company_id' => $req->company_id,
            'user_id' => $req->user_id,
            'job_post_id' => $req->job_post_id,
            'rating' => $req->rating,
        ]);

        return response()->json([
            'status' => 'submitted'
        ], 200);

    }

    
}
