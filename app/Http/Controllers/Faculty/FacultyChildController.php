<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Children;
use Illuminate\Http\Request;

class FacultyChildController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function destroy($id){
        Children::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }
}
