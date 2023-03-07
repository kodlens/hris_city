<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;



class UserHomeController extends Controller
{
    //

    public function index(){
        return view('user.user-home');
    }
    
}
