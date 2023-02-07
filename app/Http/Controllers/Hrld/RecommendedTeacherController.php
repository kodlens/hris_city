<?php

namespace App\Http\Controllers\Hrld;

use App\Http\Controllers\Controller;
use App\Models\RecommendedTeacher;
use Illuminate\Http\Request;

class RecommendedTeacherController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('hrld.recommended-teacher');
    }

    public function getRecommendedTeachers(Request $req){
        $sort = explode('.', $req->sort_by);

        return RecommendedTeacher::with(['seminar'])
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function printTeacher($id){

        $data = RecommendedTeacher::with('recommended_teacher_lists', 'seminar')
            ->where('recommended_teacher_id', $id)
            ->first();
        return view('hrld.print-teacher')
            ->with('data', $data);
    }



    public function store(Request $req){

    }
}
