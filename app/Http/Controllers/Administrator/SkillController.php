<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Skill;

class SkillController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function index(){
        return view('administrator.skills');
    }

    public function show($id){
        return Skill::find($id);
    }


    public function getSkills(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Skill::where('skill', 'like', $req->skill . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function store(Request $req){
        $validate = $req->validate([
            'skill' => ['required', 'string'],
        ]);

        Skill::create([
            'skill' => ucfirst($req->skill),
        ]);

        return response()->json([
            'status' => 'saved'
        ],200);
    }

    public function update(Request $req, $id){

        $validate = $req->validate([
            'skill' => ['required', 'string', 'unique:skills,skill,' .$id .',skill_id'],
        ]);


        $data = Skill::find($id);
        $data->skill = ucfirst($req->skill);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ],200);
    }

    public function destroy($id){
        Skill::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }




}
