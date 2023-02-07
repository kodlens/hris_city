<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';
    protected $primaryKey = 'applicant_id';

    protected $fillable = [
        'pitch', 'job_post_id',
        'user_id', 'resume_path', 
        'is_accepted', 'is_end_contract',
        'date_hired', 'employer_id'
    ];

    public function applicant(){
        return $this->hasOne(User::class, 'user_id', 'user_id')
            ->with(['province', 'city', 'barangay']);
    }

    public function job_post(){
        return $this->hasOne(JobPost::class, 'job_post_id', 'job_post_id')
            ->with(['company']);
    }
}
