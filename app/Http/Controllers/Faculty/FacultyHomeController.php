<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\FacultyParticipant;



class FacultyHomeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('faculty');
    }

    public function index(){
        return view('faculty.faculty-home');
    }

    public function imIn(Request $req){
        //return $req;
        $user = Auth::user();

        $arrData = [
            'seminar_post_id' => $req->seminar_post_id,
            'teacher_id' => $user->user_id,
            'lname' => $user->lname,
            'fname' => $user->fname,
            'mname' => $user->mname,
            'sex' => $user->sex,
            'specialization' => $req->specialization,
            'title' => $req->title,
            'remarks' => 'REQUEST'
        ];
        FacultyParticipant::create($arrData);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


}
