<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkExperience;



class FacultyWorkExperienceController extends Controller
{
    //


    public function __construct(){
        $this->middleware('auth');
    }


    public function destroy($id){
        WorkExperience::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }

}
