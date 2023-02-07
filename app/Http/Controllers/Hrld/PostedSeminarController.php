<?php

namespace App\Http\Controllers\Hrld;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostedSeminarController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('hrld.posted-seminars');
    }



}
