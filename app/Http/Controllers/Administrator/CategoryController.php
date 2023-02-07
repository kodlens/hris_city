<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');

    }


    public function index(){
        return view('administrator.category');
    }

    public function show($id){
        return Category::find($id);
    }


    public function getCategories(Request $req){
        $sort = explode('.', $req->sort_by);

        $data = Category::where('category', 'like', $req->category . '%')
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }


    public function store(Request $req){
        $validate = $req->validate([
            'category' => ['required', 'string'],
        ]);

        Category::create([
            'category' => strtoupper($req->category),
        ]);

        return response()->json([
            'status' => 'saved'
        ],200);
    }

    public function update(Request $req, $id){

        $validate = $req->validate([
            'category' => ['required', 'string', 'unique:categories,category,' .$id .',category_id'],
        ]);


        $data = Category::find($id);
        $data->category = strtoupper($req->category);
        $data->save();

        return response()->json([
            'status' => 'updated'
        ],200);
    }

    public function destroy($id){
        Category::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }


}
