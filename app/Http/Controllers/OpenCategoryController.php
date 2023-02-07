<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class OpenCategoryController extends Controller
{
    //


    public function getCategories(Request $req){
        return Category::orderBy('category', 'asc')->get();
    }
}
