<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use Auth;
use App\Models\JobPost;

class ApplyNowController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');

    }
    public function applyNow($id){

        return view('apply-now')
            ->with('job_post_id', $id);
    }

    public function store(Request $req){
        //return $req;

        $id = Auth::user()->user_id;
        $pdfPath = $req->file('dropFiles');
        $path = '';

        $employer = JobPost::with('company')
            ->find($req->job_post_id);
        $employer_id = $employer->company->user_id; //get user id of the employer

        if($pdfPath){
            $validate = $req->validate([
                'dropFiles' => ['mimes:pdf'],
            ], $message = [
                'dropFiles.mimes' => 'Type of the file must be a pdf file.'
            ]);
        }
        if($pdfPath){
            $pathFile = $pdfPath->store('public/applications'); //get path of the file
            $pdfPath = explode('/', $pathFile); //split into array using /
            $path = $pdfPath[2];
        }

        $exists = Applicant::where('job_post_id', $req->job_post_id)
            ->where('user_id', $id)
            ->exists();

        if($exists){
            return response()->json([
                'errors' => 'exists'
            ], 422);
        }

        Applicant::create([
            'pitch' => $req->pitch,
            'job_post_id' => $req->job_post_id,
            'user_id' => $id,
            'employer_id' => $employer_id,
            'resume_path' => $path,
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}
