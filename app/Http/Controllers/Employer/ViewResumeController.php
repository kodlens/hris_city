<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Applicant;

class ViewResumeController extends Controller
{

    //

    public function viewResume($applicant_id){
        return view('employer.view-resume')
            ->with('applicant_id', $applicant_id);
    }

    public function getApplicantInfo($applicant_id){
        $data = Applicant::find($applicant_id);
        return $data;
    }
}
