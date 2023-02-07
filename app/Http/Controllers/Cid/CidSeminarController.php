<?php

namespace App\Http\Controllers\Cid;

use App\Http\Controllers\Controller;
use App\Models\SeminarPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LearningDevelopment;



class CidSeminarController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('cid');

    }

    public function index(){
        return view('cid.seminar-list');
    }

    public function getTeacherSeminars(Request $req){
        $sort = explode('.', $req->sort_by);

//        $data = DB::table('learning_developments as a')
//            ->join('users as b', 'a.user_id', 'b.user_id')
//            ->select('a.*', 'b.lname', 'b.fname', 'b.mname', 'b.sex')
//            ->where('b.lname', 'like', $req->lname . '%')
//            ->orderBy($sort[0], $sort[1])
//            ->paginate($req->perpage);

        $data = SeminarPost::where('title', 'like', $req->title . '%')->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

            return $data;
    }


    public function store(Request $req){

    }

    public function updateRate(Request $req, $id){
        $data = LearningDevelopment::find($id);

        $data->ratings = $req->rating;
        $data->save();

        return response()->json([
            'status' => 'rated'
        ], 200);
    }



    public function update(Request $req, $id){

    }
}
