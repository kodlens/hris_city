<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;


class CertificateController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function upload(Request $req, $learningDevId){
        

        $files = $req->file('files');
        $file_location = '';


        if($files){
            //check the file and delete to update
            // if(Storage::exists('public/certificates/' .$data->file)) {
            //     Storage::delete('public/certificates/' . $data->bhouse_img_path);
            // }
            foreach($files as $file){
                $filePath = $file->store('public/certificates'); //get path of the file
                $filePathArray = explode('/', $filePath); //split into array using /
                $file_location = $filePathArray[2];
                Certificate::create([
                    'learning_dev_id' => $learningDevId,
                    'certificate' => $file_location
                ]);
            }
        }

        return response()->json([
            'status' => 'upload'
        ], 200);

    }

    public function delete($id){
        $data = Certificate::find($id);
        if(Storage::exists('public/certificates/' .$data->certificate)) {
            Storage::delete('public/certificates/' . $data->certificate);
        }

        Certificate::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }

}
