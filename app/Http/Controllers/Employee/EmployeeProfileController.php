<?php

namespace App\Http\Controllers\Employee;


use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
Use App\Models\User;


class EmployeeProfileController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('employee');
        $this->middleware('verified');

    }

    public function index(){
        $id = Auth::user()->user_id;
        return view('employee.employee-profile')
            ->with('id', $id); //blade.php
    }

    public function getUser($id){

        return User::with(['province', 'city', 'barangay', 'inline_categories'])
            ->where('user_id', $id)
            ->first();
    }

    public function getRating(){

    }

    public function update(Request $req, $id){
//
//        $cats = json_encode($req->categories);
//        $cat_d = json_decode($cats);
//        $cat_dd = json_decode($cat_d[0]);
//
//        return $cat_dd->category_id;


        $dob = date("Y-m-d", strtotime($req->bdate)); //convert to date format UNIX

        $data = User::find($id);

        $img = $req->file('file');
        $path = '';

        if($img){
            //check the file and delete to update
            if(Storage::exists('public/avatar/' .$data->avatar)) {
                Storage::delete('public/avatar/' . $data->avatar);
            }
            $pathFile = $img->store('public/avatar'); //get path of the file
            $imagePath = explode('/', $pathFile); //split into array using /
            $path = $imagePath[2];
        }

        $data->lname = strtoupper($req->lname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->suffix = strtoupper($req->suffix);
        $data->sex = strtoupper($req->sex);
        $data->bdate = $dob;
        $data->email = $req->email;
        $data->contact_no = $req->contact_no;
        $data->province = $req->province;
        $data->city = $req->city;

        $data->barangay = $req->barangay;
        $data->street = strtoupper($req->street);

        if($path != ''){
            $data->avatar = $path; //update image if there is an image to upload
        }
        $data->save();

        foreach ($req->categories as $cat){
            $c = json_decode($cat);
            UserCategory::updateOrCreate([
                'user_id' => $id, 'category_id' => $c->category_id
            ],
            [
                'user_id' => $id, 'category_id' => $c->category_id
            ]);
        }

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function changePassword(Request $req){

        $old_password = $req->old_password;
        $password = $req->password;

        $user = Auth::user();

        $req->validate([
            'password' => ['required', 'max:20', 'confirmed']
        ]);

        if (! Hash::check($old_password, $user->password)) {
            return response()->json([
                'errors' => array(
                    'old_password' => ['The provided password does not match our records.']
                )
            ], 422);
        }

        $data = User::find($user->user_id);
        $data->password = Hash::make($password);
        $data->save();

        return response()->json([
            'status' => 'changed'
        ], 200);

    }


}
