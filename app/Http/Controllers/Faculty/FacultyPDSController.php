<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Citizenship;
use App\Models\CivilServiceEligibility;
use App\Models\CivilStatus;
use App\Models\User;
use App\Models\WorkExperience;
use App\Models\EducationalBackground;
use App\Models\VoluntaryWork;
use App\Models\LearningDevelopment;
use App\Models\OtherInformation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyPDSController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('faculty');

    }

    public function index(){
        $id = Auth::user()->user_id;

        $civils = CivilStatus::all();
        $citizenships = Citizenship::orderBy('citizenship', 'asc')->get();
        $user = User::with(['children',
            'eligibilities',
            'work_experiences',
            'educational_backgrounds',
            'voluntary_works',
            'learning_developments',
            'other_informations'
        ])
            ->find($id);

        return view('faculty.personal-data-sheet')
            ->with('civils', $civils)
            ->with('citizenships', $citizenships)
            ->with('user', $user);
    }



    public function update(Request $req, $id){

        $req->validate([
            'surname' => ['required'],
            'fname' => ['required'],
            'school_assigned' => ['required'],
            'sex' => ['required'],
            'email' => ['required', 'unique:users,email,'. $id . ',user_id'],
            'agency_idno' => ['required']
        ],[
            'agency_idno.required' => 'Agency no. or Id no. is required.'
        ]);

        $dob = date("Y-m-d", strtotime($req->date_birth)); //convert to date format UNIX

        $data = User::find($id);
        $data->lname = strtoupper($req->surname);
        $data->fname = strtoupper($req->fname);
        $data->mname = strtoupper($req->mname);
        $data->suffix = strtoupper($req->suffix);
        $data->sex = strtoupper($req->sex);
        $data->school_assigned = strtoupper($req->school_assigned);
        $data->date_birth = $dob;
        $data->place_birth = strtoupper($req->place_birth);
        $data->civil_status = strtoupper($req->civil_status);

        $data->height = $req->height;
        $data->weight = $req->weight;
        $data->blood_type = $req->blood_type;
        $data->gsis = $req->gsis;
        $data->pagibig = $req->pagibig;
        $data->philhealth = $req->philhealth;
        $data->sss = $req->sss;
        $data->tin = $req->tin;
        $data->agency_idno = $req->agency_idno;
        $data->citizenship = strtoupper($req->citizenship);


        //spouse
        $data->spouse_surname = strtoupper($req->spouse_surname);
        $data->spouse_fname = strtoupper($req->spouse_fname);
        $data->spouse_mname = strtoupper($req->spouse_mname);
        $data->spouse_suffix = strtoupper($req->spouse_suffix);

        //business
        $data->business_name = strtoupper($req->business_name);
        $data->business_address = strtoupper($req->business_address);
        $data->business_contact_no = $req->business_contact_no;

        //father
        $data->father_surname = strtoupper($req->father_surname);
        $data->father_fname = strtoupper($req->father_fname);
        $data->father_mname = strtoupper($req->father_mname);
        $data->father_suffix = strtoupper($req->father_suffix);

        //mother
        $data->mother_maiden_name = strtoupper($req->mother_maiden_name);
        $data->mother_fname = strtoupper($req->mother_fname);
        $data->mother_mname = strtoupper($req->mother_mname);
        $data->mother_suffix = strtoupper($req->mother_suffix);

        //address residential
        $data->res_province = $req->res_province;
        $data->res_city = $req->res_city;
        $data->res_barangay = $req->res_barangay;
        $data->res_street =strtoupper($req->res_street);
        $data->res_houseno_blockno =strtoupper($req->res_houseno_blockno);
        $data->res_zipcode = $req->res_zipcode;

        //address permanent
        $data->per_province = $req->per_province;
        $data->per_city = $req->per_city;
        $data->per_barangay = $req->per_barangay;
        $data->per_street =strtoupper($req->per_street);
        $data->per_houseno_blockno =strtoupper($req->per_houseno_blockno);
        $data->per_zipcode = $req->per_zipcode;

        //contact info
        $data->tel_no = $req->tel_no;
        $data->contact_no = $req->contact_no;
        $data->email = $req->email;


        foreach($req->educational_backgrounds as $ed){
            $child = EducationalBackground::updateOrCreate(
                ['ed_bg_id' => $ed['ed_bg_id'], 'user_id' => $id],
                [
                    'level' => strtoupper($ed['level']),
                    'name_of_school' => strtoupper($ed['name_of_school']),
                    'degree' => strtoupper($ed['degree']),
                    'period_att_from' => strtoupper($ed['period_att_from']),
                    'period_att_to' => strtoupper($ed['period_att_to']),
                    'highest_level_unit' => strtoupper($ed['highest_level_unit']),
                    'year_graduated' => strtoupper($ed['year_graduated']),
                    'scholarship' => strtoupper($ed['scholarship']),
                ]
            );
        }

        foreach($req->children as $child){
            $child = Children::updateOrCreate(
                ['child_id' => $child['child_id'], 'user_id' => $id],
                [
                    'fullname' => strtoupper($child['fullname']),
                    'child_bdate' => $this->formatDate($child['date_birth']),
                ]
            );
        }

        foreach($req->eligibilities as $eligible){
            $child = CivilServiceEligibility::updateOrCreate(
                ['cse_id' => $eligible['cse_id'], 'user_id' => $id],
                [
                    'career_exam' => strtoupper($eligible['career_exam']),
                    'rating' => $eligible['rating'],
                    'date_exam' => $this->formatDate($eligible['date_exam']),
                    'place_exam' => strtoupper($eligible['place_exam']),
                    'license_no' => $eligible['license_no'],
                    'license_validity' => $eligible['license_validity'],
                ]
            );
        }

        foreach($req->work_experiences as $work){
            $child = WorkExperience::updateOrCreate(
                ['work_ex_id' => $work['work_ex_id'], 'user_id' => $id],
                [
                    'work_ex_from' => $this->formatDate($work['work_ex_from']),
                    'work_ex_to' => $this->formatDate($work['work_ex_to']),
                    'position_title' => strtoupper($work['position_title']),
                    'department_agency' => strtoupper($work['department_agency']),
                    'salary' => $work['salary'],
                    'pay_grade' => strtoupper($work['pay_grade']),
                    'status_appointment' => strtoupper($work['status_appointment']),
                    'is_govt' => $work['is_govt'],
                ]
            );
        }

        foreach($req->voluntary_works as $volunter){
            $child = VoluntaryWork::updateOrCreate(
                ['voluntary_work_id' => $volunter['voluntary_work_id'], 'user_id' => $id],
                [
                    'name_address_org' => strtoupper($volunter['name_address_org']),
                    'work_from' => $volunter['work_from'],
                    'work_to' => $volunter['work_to'],
                    'no_hours' => $volunter['no_hours'],
                    'nature_work' => strtoupper($volunter['nature_work']),
                ]
            );
        }


        foreach($req->learning_developments as $ld){
            $imgPath = $req->file('attach_file');
            if($imgPath){
                $pathFile = $imgPath->store('public/products'); //get path of the file
                $imgPath = explode('/', $pathFile); //split into array using /
            }

            $ld = LearningDevelopment::updateOrCreate(
                ['learning_dev_id' => $ld['learning_dev_id'], 'user_id' => $id],
                [
                    'title_learning_dev' => strtoupper($ld['title_learning_dev']),
                    'date_from' => $this->formatDate($ld['date_from']),
                    'date_to' => $this->formatDate($ld['date_to']),
                    'no_hours' => $ld['no_hours'],
                    'type_ld' => strtoupper($ld['type_ld']),
                    'sponsored_by' => strtoupper($ld['sponsored_by']),
                ]
            );
        }

        foreach($req->other_informations as $info){
            $child = OtherInformation::updateOrCreate(
                ['other_info_id' => $info['other_info_id'], 'user_id' => $id],
                [
                    'skill_hobbies' => strtoupper($info['skill_hobbies']),
                    'non_academic_distinction' => strtoupper($info['non_academic_distinction']),
                    'member_association' => strtoupper($info['member_association']),
                ]
            );
        }

        $data->related_with_third_degree = $req->related_with_third_degree;
        $data->related_with_fourth_degree = $req->related_with_fourth_degree;
        $data->related_with_fourth_degree_yes = $req->related_with_fourth_degree_yes;
        $data->is_guilty_administrative_offense = $req->is_guilty_administrative_offense;
        $data->is_guilty_administrative_offense_yes = $req->is_guilty_administrative_offense_yes;
        $data->is_criminally_charge = $req->is_criminally_charge;
        $data->is_criminally_charge_yes = $req->is_criminally_charge_yes;
        $data->date_filed = $req->date_filed;
        $data->case_status = $req->case_status;
        $data->is_convicted = $req->is_convicted;
        $data->is_convicted_yes = $req->is_convicted_yes;
        $data->is_separated = $req->is_separated;
        $data->is_separated_yes_details = $req->is_separated_yes_details;
        $data->is_candidate_election = $req->is_candidate_election;
        $data->is_candiadte_election_yes = $req->is_candiadte_election_yes;
        $data->is_resigned = $req->is_resigned;
        $data->is_resigned_yes = $req->is_resigned_yes;
        $data->is_immigrant = $req->is_immigrant;
        $data->is_immigrant_yes = $req->is_immigrant_yes;

        $data->is_indigenous = $req->is_indigenous;
        $data->is_indigenous_yes = $req->is_indigenous_yes;
        $data->is_disable = $req->is_disable;
        $data->is_disable_id_no = $req->is_disable_id_no;
        $data->is_solo_parent = $req->is_solo_parent;
        $data->is_solo_parent_yes = $req->is_solo_parent_yes;

        $data->save();

        return response()->json([
            'status' => 'saved'
        ],200);

    }

    public function formatDate($d){
        return date("Y-m-d", strtotime($d));
    }
}
