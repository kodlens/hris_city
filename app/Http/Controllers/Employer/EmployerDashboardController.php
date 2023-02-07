<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployerDashboardController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index(){
        return view('employer.employer-dashboard');
    }


}
