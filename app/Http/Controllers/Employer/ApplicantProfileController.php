<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ApplicantProfileController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');

    }

    public function index($id){
        $user = User::with(['province', 'city', 'barangay'])->where('user_id', $id)
            ->first();

        return view('employer.applicant-profile')
            ->with('user', $user);
    }


}
