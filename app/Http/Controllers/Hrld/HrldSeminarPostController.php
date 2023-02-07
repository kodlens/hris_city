<?php

namespace App\Http\Controllers\Hrld;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeminarPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class HrldSeminarPostController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('hrld.seminar-posts');
    }

    public function show($id){
        return SeminarPost::find($id);
    }

    public function getSeminars(){

//        $queryBuilder = DB::table('users as a')
//            ->where('role', 'FACULTY')
//            ->select('a.user_id', 'a.lname', 'a.fname', 'a.mname',
//                DB::raw('(select count(*) from learning_developments where user_id = a.user_id) as no_seminars'),
//                DB::raw('IFNULL((SELECT GROUP_CONCAT(skill_hobbies SEPARATOR ", ") FROM other_informations WHERE user_id = a.user_id),"") as specialization'),
//
//                'a.role', 'a.suffix', 'a.sex', 'a.civil_status');
//
//        $ndata = DB::table($queryBuilder)
//            ->where('specialization', 'like', '%' .$req->specialization . '%')
//            ->orderBy('no_seminars', 'asc')
//            ->get();

        $data = SeminarPost::whereDate('seminar_date', '>=', date('Y-m-d'))
//            ->with(['recommended_teachers' => function($q){
//                $q->DB::tab
//            }])
            ->orderBy('seminar_post_id', 'desc')->get();
        return $data;
    }


    public function store(Request $req){


        $file = $req->file('file');
        $file_location = '';
        $dateSeminar = date('Y-m-d', strtotime($req->seminar_date));

        if($file){
            //check the file and delete to update
            // if(Storage::exists('public/certificates/' .$data->file)) {
            //     Storage::delete('public/certificates/' . $data->bhouse_img_path);
            // }

            $filePath = $file->store('public/seminars'); //get path of the file
            $filePathArray = explode('/', $filePath); //split into array using /
            $file_location = $filePathArray[2];
        }

        $data = SeminarPost::create([
            'title' => $req->title,
            'seminar_date' => $dateSeminar,
            'ld_type' => $req->ld_type,
            'skills' => $req->skills,
            'conducted_by' => $req->conducted_by,
            'cpd_units' => $req->cpd_units,
            'no_hours' => $req->no_hours,
            'specialization' => $req->specialization,
            'img_path' => $file_location,
            'date_posted' => date('Y-m-d'),
            'description' => $req->description,
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    public function update(Request $req, $id){

        $file = $req->file('file');
        $file_location = '';

        $data = SeminarPost::find($id);

        if($file){
            //check the file and delete to update
             if(Storage::exists('public/seminars/' .$data->img_path)) {
                 Storage::delete('public/seminars/' . $data->img_path);
             }
            $filePath = $file->store('public/seminars'); //get path of the file
            $filePathArray = explode('/', $filePath); //split into array using /
            $file_location = $filePathArray[2];

            $data->img_path = $file_location;
        }

        $data->title = $req->title;
        $data->seminar_date = $req->seminar_date;
        $data->ld_type = $req->ld_type;
        $data->skills = $req->skills;
        $data->conducted_by = $req->conducted_by;
        $data->cpd_units = $req->cpd_units;
        $data->no_hours = $req->no_hours;
        $data->specialization = $req->specialization;

        $data->description = $req->description;
        $data->save();


        return response()->json([
            'status' => 'updated'
        ], 200);

    }

    public function destroy($id){

        SeminarPost::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}
