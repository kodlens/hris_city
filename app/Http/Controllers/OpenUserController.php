<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;


class OpenUserController extends Controller
{
    //
    public function getUser($id){
        return User::where('user_id', $id)->first();
    }

    public function getLoggedUser(){
        return Auth::user();
    }

}
