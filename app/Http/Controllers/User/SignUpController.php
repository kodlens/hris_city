<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Http;

class SignUpController extends Controller
{
    //
    public function index(){
        return view('user.sign-up');
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

        ///$msg = 'Hi '.$req->lname . ', ' . $req->fname . '. Welcome to Dental Clinic Services. You have successfully created an account.';
        //$qr_code = substr(md5(time() . $req->lname . $req->fname), -8);

        $data = [];
        \DB::transaction(function () use($req, &$data) {
            $user = User::create([
                //'qr_ref' => $qr_code,
                'username' => $req->username,
                'password' => Hash::make($req->password),
                'email' => $req->email,
                'lname' => strtoupper($req->lname),
                'fname' => strtoupper($req->fname),
                'mname' => strtoupper($req->mname),
                'suffix' => strtoupper($req->suffix),
                'sex' => $req->sex,
                'contact_no' => $req->contact_no,
                'role' => 'EMPLOYEE',
                'province' => $req->province,
                'city' => $req->city,
                'barangay' => $req->barangay,
                'street' => strtoupper($req->street)
            ]);
    
           
            foreach($req->categories as $item){
                array_push($data, 
                    ['user_id' => $user->user_id, 'category_id' => $item['category_id']], 
                );  
            }

           // return $data;
    
            UserCategory::insert($data);
        });

       // return $data;

        return response()->json([
            'status' => 'saved'
        ],200);
    }
}
