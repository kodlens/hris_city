<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearningDevelopmentType;
use App\Models\Specialization;

class OpenController extends Controller
{
    //

    public function loadLearningDevTypes(Request $req){

        return LearningDevelopmentType::orderBy('ld_type', 'asc')
            ->get();
        
    }

    public function loadSpecializations(Request $req){

        return Specialization::orderBy('specialization', 'asc')
            ->get();
        
    }
}
