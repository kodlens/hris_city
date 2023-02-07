<?php

namespace App\Http\Controllers\Hrld;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrldHomeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('hrld.hrld-home');
    }
}
