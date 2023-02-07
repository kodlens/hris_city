<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerType;

class EmployerTypeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function getEmployerTypes(Request $req){
        return EmployerType::orderBy('public_private', 'asc')
            ->get();
    }
}
