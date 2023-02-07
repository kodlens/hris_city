<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostSkill extends Model
{
    use HasFactory;

    protected $table = 'job_post_skills';
    protected $primaryKey = 'job_post_skill_id';


    protected $fillable = ['job_post_id', 'job_post_skill'];



}
