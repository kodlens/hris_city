<?php

namespace App\Http\Controllers\Cid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CidHomeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('cid');

    }

    public function index(){
        return view('cid.cid-home');
    }
}
