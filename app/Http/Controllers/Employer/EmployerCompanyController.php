<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

use Auth;


class EmployerCompanyController extends Controller
{
    //

    public function __constructor(){
        $this->middleware('auth');
        $this->middleware('verified');

    }

    public function index(){
        return view('employer.employer-dashboard');
    }

    public function show($id){
        return Company::find($id);
    }

    public function getMyCompanies(){
        $id = Auth::user()->user_id;
        return Company::with(['province', 'city', 'owner_account'])
            ->where('user_id', $id)->get();

    }

    public function create(){
        return view('employer.employer-company-add-edit')
            ->with('id', 0);
    }

    public function edit($id){
        return view('employer.employer-company-add-edit')
            ->with('id', $id);
    }

    public function store(Request $req){
        $id = Auth::user()->user_id;

        $validate = $req->validate([
            'company' => ['required'],
           
            'main_branch' => ['required'],
            'employer_type' => ['required'],
            'total_work_force' => ['required'],
            'tin' => ['required'],

            'owner' => ['required'],
            //'company_logo' => ['required', 'mimes:jpg,png,bmp'],
            'overview' => ['required'],
            'email' => ['required'],

            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],

        ], $message = [
            //'bhouse_img_path.mimes' => 'Type of the file must be jpg, png or bmp.',
            //'bhouse_img_path.required' => 'Image is required.'
        ]);
       
        // $company_logo = null;
        // //upload image b house
        // $company_logo = $req->file('company_logo');
        // if($bhouseImg){
        //     $pathFile = $company_logo->store('public/company'); //get path of the file
        //     $companyLogoPath = explode('/', $pathFile); //split into array using /
        // }

        Company::create([
            'user_id' => $id,
            'company' => strtoupper($req->company),
            'trade_name' => strtoupper($req->trade_name),
            'accronym' => $req->accronym,
            'main_or_branch' => $req->main_or_branch,
            'employer_type' => $req->employer_type,
            'overview' => $req->overview,
            'total_work_force' => $req->total_work_force,
            'website' => $req->website,

            'industry' => strtoupper($req->industry),
            'benefits_others' => strtoupper($req->benefits_others),
            'tin' => $req->tin,

            'owner' => strtoupper($req->owner),
            'contact_person' => strtoupper($req->contact_person),
            'contact_position' => strtoupper($req->contact_position),
            'phone_contact' => $req->phone_contact,
            'fb_contact' => $req->fb_contact,
            'twitter_contact' => $req->twitter_contact,
            'insta_contact' => $req->insta_contact,
            'viber_contact' => $req->viber_contact,
            'whatsapp_contact' => $req->whatsapp_contact,
            'email' => $req->email,

            'province' => $req->province,
            'city' => $req->city,
            'barangay' => $req->barangay,
            'street' => $req->street,

            //'company_logo' => $companyLogoPath[2] != null ? $companyLogoPath[2]: '',
        ]);

        return response()->json([
            'status' => 'saved'
        ], 200);
    }


    public function update(Request $req, $id){
        $validate = $req->validate([
            'company' => ['required'],
           
            'main_branch' => ['required'],
            'employer_type' => ['required'],
            'total_work_force' => ['required'],
            'tin' => ['required'],
            //'company_logo' => ['required', 'mimes:jpg,png,bmp'],
            'overview' => ['required'],
            'email' => ['required'],

            'province' => ['required'],
            'city' => ['required'],
            'barangay' => ['required'],

        ], $message = [
            //'bhouse_img_path.mimes' => 'Type of the file must be jpg, png or bmp.',
            //'bhouse_img_path.required' => 'Image is required.'
        ]);
       
        // $company_logo = null;
        // //upload image b house
        // $company_logo = $req->file('company_logo');
        // if($bhouseImg){
        //     $pathFile = $company_logo->store('public/company'); //get path of the file
        //     $companyLogoPath = explode('/', $pathFile); //split into array using /
        // }

        $data = Company::find($id);

        $data->company = strtoupper($req->company);
        $data->trade_name = strtoupper($req->trade_name);
        $data->accronym = $req->accronym;
        $data->main_or_branch = $req->main_or_branch;
        $data->employer_type = $req->employer_type;
        $data->overview = $req->overview;
        $data->total_work_force = $req->total_work_force;
        $data->website = $req->website;


        $data->industry = strtoupper($req->industry);
        $data->benefits_others = strtoupper($req->benefits_others);
        $data->tin = $req->tin;

        $data->owner = strtoupper($req->owner);
        $data->contact_person = strtoupper($req->contact_person);
        $data->contact_position = strtoupper($req->contact_position);
        $data->phone_contact = $req->phone_contact;
        $data->fb_contact = $req->fb_contact;
        $data->twitter_contact = $req->twitter_contact;
        $data->insta_contact = $req->insta_contact;
        $data->viber_contact = $req->viber_contact;
        $data->whatsapp_contact = $req->whatsapp_contact;
        $data->email = $req->email;

        $data->province = $req->province;
        $data->city = $req->city;
        $data->barangay = $req->barangay;
        $data->street = $req->street;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ], 200);
    }


      
    
    public function destroy($id){
        Company::destroy($id);

        return response()->json([
            'status' => 'deleted'
        ], 200);
    }
    
}
