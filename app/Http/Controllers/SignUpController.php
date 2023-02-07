<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Http;

class SignUpController extends Controller
{
    //
    public function index(){
        return view('sign-up');
    }


    public function store(Request $req){


        $validate = $req->validate([
            'username' => ['required', 'string', 'unique:users'],
            'lname' => ['required', 'string', 'max:100'],
            'fname' => ['required', 'string', 'max:100'],
            'sex' => ['required', 'string', 'max:20'],
            'school_assigned' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'res_province' => ['required', 'string'],
            'res_city' => ['required', 'string'],
            'res_barangay' => ['required', 'string'],
            'agency_idno' => ['required'],
            //'skill_hobbies' => ['required']
        ],[
            'agency_idno.required' => 'Agency No or Id No. is required.'
        ]);


       // $qr_code = substr(md5(time() . $req->lname . $req->fname), -8);

        User::create([
            //'qr_ref' => $qr_code,
            'username' => $req->username,
            'password' => Hash::make($req->password),
            'email' => $req->email,
            'lname' => strtoupper($req->lname),
            'fname' => strtoupper($req->fname),
            'mname' => strtoupper($req->mname),
            'suffix' => strtoupper($req->suffix),
            'sex' => $req->sex,
            'school_assigned' => strtoupper($req->school_assigned),
            'contact_no' => $req->contact_no,
            'role' => 'FACULTY',
            'res_province' => $req->res_province,
            'res_city' => $req->res_city,
            'res_barangay' => $req->res_barangay,
            'res_street' => strtoupper($req->res_street),
            'agency_idno' => $req->agency_idno,
            //'skill_hobbies' => $req->skill_hobbies,
        ]);

        // try{
        //     Http::withHeaders([
        //         'Content-Type' => 'text/plain'
        //     ])->post('http://'. env('IP_SMS_GATEWAY') .'/services/api/messaging?Message='.$msg.'&To='.$req->contact_no.'&Slot=1', []);
        // }catch(Exception $e){} //just hide the error

        return response()->json([
            'status' => 'saved'
        ],200);
    }
}
