<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }



    public function index(){
        return view('administrator.category');
    }

    public function show($id){
        return Company::find($id);
    }


    public function getCategories(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Company::where('company', 'like', $req->company . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function store(Request $req){
        $validate = $req->validate([
            'company' => ['required', 'string'],
        ]);

        Company::create([
            'company' => strtoupper($req->company),
            'owner' => strtoupper($req->owner),
            'desc' => $req->desc,
            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay,
        ]);

        return response()->json([
            'status' => 'saved'
        ],200);
    }

    public function update(Request $req, $id){

        $validate = $req->validate([
            'company' => ['required', 'string', 'unique:companies,company,' .$id .',company_id'],
        ]);


        $data = Company::find($id);
        $data->company = strtoupper($req->company);
        $data->owner = strtoupper($req->owner);
        $data->desc = $req->desc;
        $data->province = $req->province;
        $data->city = $req->city;
        $data->barangay = $req->barangay;

        $data->save();

        return response()->json([
            'status' => 'updated'
        ],200);
    }

    public function destroy($id){
        Company::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }
}
