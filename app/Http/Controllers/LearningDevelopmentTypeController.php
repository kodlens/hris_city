<?php

namespace App\Http\Controllers;

use App\Models\LearningDevelopment;
use Illuminate\Http\Request;
use App\Models\LearningDevelopmentType;

class LearningDevelopmentTypeController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('administrator.learning-dev-type');
    }

    public function getLearningDevelopmentTypes(Request $req){
        $sort = explode('.', $req->sort_by);

        return LearningDevelopmentType::where('ld_type', 'like', $req->ld_type . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function show($id){
        return LearningDevelopmentType::find($id);
    }

    public function store(Request $req){
        $req->validate([
            'ld_type' => ['required']
        ]);

        LearningDevelopmentType::create([
            'ld_type' => strtoupper($req->ld_type),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
        $req->validate([
            'ld_type' => ['required', 'unique:learning_development_types,ld_type,' .$id. ',ld_type_id']
        ]);

        $data = LearningDevelopmentType::find($id);
        $data->ld_type =  strtoupper($req->ld_type);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        LearningDevelopmentType::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}
