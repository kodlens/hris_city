<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Applicant;
use App\Models\JobPost;

class ApplicantListController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verified');

    }

    public function index(){
        return view('employer.applicant-list');
    }

    public function getJobPostList(Request $req){
     
        $user = Auth::user();
        $sort = explode('.', $req->sort_by);

        // $data = DB::table('applicants as a')
        //     ->join('job_posts as b', 'a.job_post_id', 'b.job_post_id')
        //     ->join('companies as c', 'b.company_id', 'c.company_id')
        //     ->join('users as d', 'a.user_id', 'd.user_id')
        //     ->where('c.user_id', $user->user_id)
        //     ->orderBy('a.applicant_id', 'desc')
        //     ->paginate($req->perpage);

        // return $data;


        // $data = Applicant::with(['applicant', 'job_post'])
        //     ->addSelect(['total_rating' => function ($q){
        //         $q->selectRaw('sum(rating)')
        //         ->from('employee_ratings')
        //         ->whereColumn('user_id', 'applicants.user_id');
        //     }])
        //     ->addSelect(['total_raters' => function ($q){
        //         $q->selectRaw('count(*)')
        //         ->from('employee_ratings')
        //         ->whereColumn('user_id', 'applicants.user_id');
        //     }])
        //     ->selectRaw('(select(total_rating) / (select count(*) from employee_ratings where user_id = applicants.user_id)) as user_total_rating')
        //     ->where('employer_id', $user->user_id)
        //     ->orderBy('applicant_id', 'desc')
        //     ->paginate($req->perpage);
       

            //TO CONTINUE
        $data = DB::table('job_posts as a')
            ->join('companies as b', 'a.company_id', 'b.company_id')
            ->select('a.job_post_id', 'a.company_id', 'title', 'job_desc',
                'b.company', 'b.user_id',
                DB::raw('(select sum(rating) from employee_ratings where user_id = b.user_id) as total_rating'),
                DB::raw('(select count(*) from employee_ratings where user_id = b.user_id) as total_raters)'),
                DB::raw('(select(total_rating) / (select count(*) from employee_ratings where user_id = applicants.user_id) as )')

                )
            ->where('b.user_id', $user->user_id)
            ->get();

        return $data;
    }

    public function endContract($id){
        $data = Applicant::find($id);
        $data->is_end_contract = 1;
        $data->save();

        return response()->json([
            'status' => 'ended'
        ], 200);
    }



}
