<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class OpenSkillController extends Controller
{
    //

    public function getOpenSkills(Request $req){
        return Skill::orderBy('skill', 'asc')->get();
    }

}
