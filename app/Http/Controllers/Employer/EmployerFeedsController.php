<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerFeedsController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($companyId){
        return view('employer.employer-feeds');
    }


}
