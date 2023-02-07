<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VoluntaryWork;

class FacultyVoluntaryWorkController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function destroy($id){
        VoluntaryWork::destroy($id);
        return response()->json([
            'status' => 'deleted'
        ],200);
    }

}
