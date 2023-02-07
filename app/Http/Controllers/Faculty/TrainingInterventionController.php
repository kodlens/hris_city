<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\LearningDevelopment;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;

class TrainingInterventionController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('faculty');

    }


    public function index(){
        $user = Auth::user();
        return view('faculty.trainings-interventions')
            ->with('user', $user);
    }


    public function getLearningTrainings(Request $req){

        $sort = explode('.', $req->sort_by);

        $user = Auth::user();

        $data = LearningDevelopment::with(['certificates'])
            ->where('user_id', $user->user_id)
            ->orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);
            
        return $data;
    }

    public function create(){
        $user = Auth::user();
        return view('faculty.trainings-interventions-store-update')
            ->with('user', $user)
            ->with('id', 0);
    }

    public function store(Request $req){

        $user = Auth::user();

        $dateFrom = date("Y-m-d", strtotime($req->date_from)); //convert to date format UNIX
        $dateTo = date("Y-m-d", strtotime($req->date_to)); //convert to date format UNIX

        $files = $req->file('files');
        $file_location = '';

        $data = LearningDevelopment::create([
            'user_id' => $user->user_id,
            'title_learning_dev' => ucfirst($req->title_learning_dev),
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'no_hours' => $req->no_hours,
            'type_ld' => $req->type_ld,
            'sponsored_by' => $req->sponsored_by,
        ]);

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
                    'learning_dev_id' => $data->learning_dev_id,
                    'certificate' => $file_location
                ]);
            }
        }

        return response()->json([
            'status' => 'saved'
        ], 200);
    }

    public function edit($id){
        $user = Auth::user();

        $data = LearningDevelopment::find($id);

        return view('faculty.trainings-interventions-store-update')
            ->with('id', $id)
            ->with('user', $user)
            ->with('data', $data);
    }

    public function update(Request $req, $id){
        
        $data = LearningDevelopment::find($id);

        $dateFrom = date("Y-m-d", strtotime($req->date_from)); //convert to date format UNIX
        $dateTo = date("Y-m-d", strtotime($req->date_to)); //convert to date format UNIX

        $data->title_learning_dev = ucfirst($req->title_learning_dev);
        $data->date_from = $dateFrom;
        $data->date_to = $dateTo;
        $data->no_hours = $req->no_hours;
        $data->type_ld = $req->type_ld;
        $data->sponsored_by = $req->sponsored_by;

        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }

    public function destroy($id){
        $data = LearningDevelopment::find($id);
        if(Storage::exists('public/certificates/' .$data->img_path)) {
            Storage::delete('public/certificates/' . $data->img_path);
        }
        LearningDevelopment::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ]);
    }



    
}
