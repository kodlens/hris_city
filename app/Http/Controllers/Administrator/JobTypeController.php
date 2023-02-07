<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Jobtype;
use Illuminate\Http\Request;

class JobTypeController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function index(){
        return view('administrator.jobtype');
    }

    public function show($id){
        return Jobtype::find($id);
    }


    public function getJobTypes(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Jobtype::where('jobtype', 'like', $req->jobtype . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function store(Request $req){
        $validate = $req->validate([
            'jobtype' => ['required', 'string'],
        ]);

        Jobtype::create([
            'jobtype' => strtoupper($req->jobtype),
        ]);

        return response()->json([
            'status' => 'saved'
        ],200);
    }

    public function update(Request $req, $id){

        $validate = $req->validate([
            'jobtype' => ['required', 'string', 'unique:job_types,jobtype,' .$id .',jobtype_id'],
        ]);


        $data = Jobtype::find($id);
        $data->jobtype = strtoupper($req->jobtype);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ],200);
    }

    public function destroy($id){
        Jobtype::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }

}
