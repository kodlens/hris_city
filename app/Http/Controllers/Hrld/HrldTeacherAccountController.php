<?php

namespace App\Http\Controllers\Hrld;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class HrldTeacherAccountController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('hrld.teacher-accounts');
    }

    public function getTeacherAccounts(Request $req){
        //for Item Management
        $sort = explode('.', $req->sort_by);

        return User::with(['residential_province', 'residential_city', 'residential_barangay', 'learning_developments',
            'permanent_province', 'permanent_city', 'permanent_barangay',
            'children', 'educational_backgrounds'
        ])
            ->where('role', '=', 'FACULTY')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function approveAccount($id){
        $data = User::find($id);
        $data->is_verified = 1;
        $data->save();

        return response()->json([
            'status' => 'approved'
        ], 200);
    }



    public function store(Request $req){

        $data = Auth::user();

        return $req;
    }

}
