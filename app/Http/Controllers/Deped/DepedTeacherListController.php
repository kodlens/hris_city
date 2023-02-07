<?php

namespace App\Http\Controllers\Deped;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepedTeacherListController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('deped.teacher-list');
    }
}
