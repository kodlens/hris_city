<?php

namespace App\Http\Controllers\Cid;

use App\Http\Controllers\Controller;
use App\Models\RecommendedTeacher;

use App\Models\RecommendedTeacherList;
use App\Models\SeminarPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FacultyParticipant;


class RecommendedCandidateController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('cid');
    }

    public function index(){
        return view('cid.recommended-candidate');
    }

    public function generateList(Request $req){
        //->whereRaw('(select specialization) like ?', [$req->sspecialization . '%'])

        $queryBuilder = DB::table('users as a')
            ->where('role', 'FACULTY')
            ->select('a.user_id', 'a.lname', 'a.fname', 'a.mname',
                DB::raw('(select count(*) from learning_developments where user_id = a.user_id) as no_seminars'),
                DB::raw('IFNULL((SELECT GROUP_CONCAT(skill_hobbies SEPARATOR ", ") FROM other_informations WHERE user_id = a.user_id),"") as specialization'),

                'a.role', 'a.suffix', 'a.sex', 'a.civil_status')
            ->where('a.lname', 'like', $req->lname . '%');

        $data = DB::table($queryBuilder)
                ->where('specialization', 'like', '%' .$req->specialization . '%')
                ->orderBy('no_seminars', 'asc')
                ->get();

        return $data;
    }

    public function getRequestTeacher($id){
        $data = FacultyParticipant::where('seminar_post_id', $id)
        ->orderBy('faculty_participant_id', 'asc')
            ->get();
            return $data;
    }


    public function getSeminarSpecializationList(Request $req){
        $data = SeminarPost::where('title', 'like', $req->title . '%')
            ->whereDate('seminar_date', '>=', date('Y-m-d'))
            ->get();

        return $data;
    }


    public function store(Request $req){

        $data = RecommendedTeacher::create([
            'seminar_post_id' => $req->seminar_post_id,
            'seminar_title' => $req->seminar_title,
            'remarks' => $req->remarks,
        ]);

        foreach($req->teachers as $item){
            RecommendedTeacherList::create([
                'recommended_teacher_id' => $data->recommended_teacher_id,
                'teacher_id' => $item['user_id'],
                'lname' => $item['lname'],
                'fname' => $item['fname'],
                'mname' => $item['mname'],
                'sex' => $item['sex'],
                'specialization' => $item['specialization'],
                'no_seminars' => $item['no_seminars'],
            ]);
        }


        return response()->json([
            'status' => 'saved'
        ], 200);

    }


}
