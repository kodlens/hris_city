<?php

namespace App\Http\Controllers\Administrator\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use Illuminate\Support\Facades\DB;


class ReportHiredController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        //by date hired
        //by brgy employee
        //company
        //employer
     
        // $data = Applicant::where('is_accepted', 1)
        //     ->with(['applicant', 'job_post'])
        //     ->get();

        return view('administrator.report.hired-list');
    }

    public function getApplicantReport(Request $req){
     
        

        $data = DB::table('applicants as a')
            ->join('job_posts as b', 'a.job_post_id', 'b.job_post_id')
            ->join('companies as c', 'b.company_id', 'c.company_id')
            ->join('companies as d', 'c.company_id', 'd.company_id')
            ->join('users as e', 'd.user_id', 'e.user_id')
            ->join('users as f', 'a.user_id', 'f.user_id')
            ->join('barangays as g', 'f.barangay', 'g.brgyCode')
            ->select('a.*', 
                'b.*',
                'c.*',
                'd.*',
                'g.*',
                'e.lname as company_lname', 'e.fname as company_fname', 'e.mname as company_mname',
                'f.lname as emp_lname', 'f.fname as emp_fname', 'f.mname as emp_mname', 'f.sex as emp_sex', 'f.contact_no as emp_contact_no'
            )
            ->where('c.company', 'like', $req->company . '%')
            ->where('e.lname', 'like', $req->employer . '%')
            ->where('g.brgyDesc', 'like', $req->barangay . '%');

            if($req->datehired != null){
                
                $ndate = date("Y-m-d", strtotime($req->datehired)); //convert to date format UNIX
            
                return $data->where('a.date_hired', $ndate)
                    ->get();
            }else{
               
                return $data->get();
            }
       
    }

    
}
