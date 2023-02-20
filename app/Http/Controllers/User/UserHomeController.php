<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;



class UserHomeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('user');
    }

    public function index(){
        return view('user.user-home');
    }


}
