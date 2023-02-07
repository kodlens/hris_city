<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\CivilServiceEligibility;
use Illuminate\Http\Request;

class FacultyCSEController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function destroy($id){
        CivilServiceEligibility::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }

}
