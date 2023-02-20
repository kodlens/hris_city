<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\LearningDevelopment;
use Illuminate\Support\Facades\Storage;


class FacultyLearningDevelopmentController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        
    }


    public function destroy($id){

        $data = Certificate::where('learning_dev_id', $id)->get();

        foreach($data as $item){
            if(Storage::exists('public/certificates/' . $item->certificate)) {
                Storage::delete('public/certificates/' . $item->certificate);
            }
        }
        
        LearningDevelopment::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ],200);
    }


}
