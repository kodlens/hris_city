<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function changePassword(Request $req){
        $user = Auth::user();
        $old_password = $req->old_password;
        $password = $req->password;

        $req->validate([
            'password' => ['required', 'confirmed']
        ]);

        if(Hash::check($old_password, $user->password)){
            $data = User::find($user->user_id);
            $data->password = Hash::make($password);
            $data->save();

            return response()->json([
                'status' => 'changed'
            ], 200);
        }else{
            return response()->json([
                'errors' => [
                    'old_password' => ['Password error.']
                ]
            ], 422);
        }
    }


}
