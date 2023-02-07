<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployerSignUpController extends Controller
{
    //

    public function __construct(){

    }


    public function index(){
        return view('employer.employer-signup');
    }

    public function store(Request $req){
    
        $validate = $req->validate([
            'username' => ['required', 'string', 'unique:users'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'barangay' => ['required', 'string'],
        ]);


       // $qr_code = substr(md5(time() . $req->lname . $req->fname), -8);

        User::create([
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'email' => $req->email,
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'suffix' => strtoupper($req->suffix),
            'sex' => $req->sex,
            'contact_no' => $req->contact_no,
            'role' => 'EMPLOYER',
            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay,
            'street' => strtoupper($req->street)
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }
}
