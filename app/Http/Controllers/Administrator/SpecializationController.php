<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        return view('administrator.specialization');
    }

    public function getSpecialization(Request $req){
        $sort = explode('.', $req->sort_by);

        return Specialization::where('specialization', 'like', $req->specialization . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
    }

    public function show($id){
        return Specialization::find($id);
    }

    public function store(Request $req){
        $req->validate([
            'specialization' => ['required']
        ]);

        Specialization::create([
            'specialization' => strtoupper($req->specialization),
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
        $req->validate([
            'specialization' => ['required', 'unique:specializations,specialization,' .$id. ',specialization_id']
        ]);

        $data = Specialization::find($id);
        $data->specialization =  strtoupper($req->specialization);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        Specialization::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
}
