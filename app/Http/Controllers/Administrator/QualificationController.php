<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qualification;

class QualificationController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function index(){
        return view('administrator.qualification');
    }

    public function show($id){
        return Qualification::find($id);
    }

    public function getQualifications (Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Qualification::where('qualification', 'like', $req->qualification . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
        return $data;
    }


    public function store(Request $req){
        $validate = $req->validate([
            'qualification' => ['required', 'string'],
        ]);

        Qualification::create([
            'qualification' => strtoupper($req->qualification),
        ]);

        return response()->json([
            'status' => 'saved'
        ],200);
    }

    public function update(Request $req, $id){

        $validate = $req->validate([
            'qualification' => ['required', 'string', 'unique:qualifications,qualification,' .$id .',qualification_id'],
        ]);


        $data = Qualification::find($id);
        $data->qualification = strtoupper($req->qualification);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ],200);
    }

    public function destroy($id){
        Qualification::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }



}
