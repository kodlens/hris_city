<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username', 'lname', 'fname', 'mname',
        'extension', 'date_birth', 'sex', 
        'civil_status',
        'civil_status_others', 'height', 'weight', 'blood_type', 'gsis',
        'pagibig', 'philhealth', 'sss', 'tin', 'agency_idno', 'citizenship',
        'res_province', 'res_city', 'res_barangay', 'res_street', 'res_houseno_blockno', 'res_zipcode',
        'per_province', 'per_city', 'per_barangay', 'per_street', 'per_houseno_blockno', 'per_zipcode',
        'tel_no', 'contact_no', 'email',
        'spouse_surname', 'spouse_fname', 'spouse_mname', 'spouse_extension', 'spouse_occupation',
        'business_name', 'business_address', 'business_contact_no',
        'father_surname', 'father_fname', 'father_mname', 'father_extension',
        'mother_surname', 'mother_fname', 'mother_mname', 'mother_extension',
        'role', 'password', 'is_verified',
        'related_with_third_degree',
        'related_with_fourth_degree',
        'related_with_fourth_degree_yes',
        'is_guilty_administrative_offense',
        'is_guilty_administrative_offense_yes',
        'is_criminally_charge',
        'is_criminally_charge_yes',
        'date_filed',
        'case_status',
        'is_convicted',
        'is_convicted_yes',
        'is_separated',
        'is_separated_yes_details',
        'is_candidate_election',
        'is_candiadte_election_yes',
        'is_resigned',
        'is_resigned_yes',
        'is_immigrant',
        'is_immigrant_yes',
        'is_indigenous',
        'is_indigenous_yes',
        'is_disable',
        'is_disable_id_no',
        'is_solo_parent',
        'is_solo_parent_yes',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function children(){
        return $this->HasMany(Children::class, 'user_id', 'user_id');
    }

    public function eligibilities(){
        return $this->HasMany(CivilServiceEligibility::class, 'user_id', 'user_id');
    }

    public function work_experiences(){
        return $this->HasMany(WorkExperience::class, 'user_id', 'user_id');
    }

    public function educational_backgrounds(){
        return $this->HasMany(EducationalBackground::class, 'user_id', 'user_id');
    }

    public function voluntary_works(){
        return $this->HasMany(VoluntaryWork::class, 'user_id', 'user_id');
    }

    public function learning_developments(){
        return $this->HasMany(LearningDevelopment::class, 'user_id', 'user_id')
            ->with(['certificates']);
    }

    public function other_informations(){
        return $this->HasMany(OtherInformation::class, 'user_id', 'user_id');
    }




    //residential
    public function residential_province(){
        return $this->hasOne(Province::class, 'provCode', 'res_province');
    }
    public function residential_city(){
        return $this->hasOne(City::class, 'citymunCode', 'res_city');
    }
    public function residential_barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'res_barangay');
    }
    

    //permanent
    public function permanent_province(){
        return $this->hasOne(Province::class, 'provCode', 'per_province');
    }
    public function permanent_city(){
        return $this->hasOne(City::class, 'citymunCode', 'per_city');
    }
    public function permanent_barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'per_barangay');
    }






}
