<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;


    protected $table = 'job_posts';
    protected $primaryKey = 'job_post_id';

    protected $fillable = ['company_id', 'jobtype_id', 'title', 'job_desc', 
        'minimum_experience', 'minimum_qualification',
        'category_id', 'from_salary', 'to_salary',
        'province', 'city', 'barangay', 'street'
    ];


    public function company(){
        return $this->hasOne(Company::class, 'company_id', 'company_id')
            ->with(['province', 'city', 'barangay']);
    }

    public function jobtype(){
        return $this->hasOne(Jobtype::class, 'jobtype_id', 'jobtype_id');
    }

    public function category(){
        return $this->hasOne(Category::class, 'category_id', 'category_id');
    }

    public function skills(){
        return $this->hasMany(jobPostSkill::class, 'job_post_id', 'job_post_id');
    }



    //addresses
    public function province(){
        return $this->hasOne(Province::class, 'provCode', 'province');
    }

    public function city(){
        return $this->hasOne(City::class, 'citymunCode', 'city');
    }
    public function barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'barangay');
    }


}
