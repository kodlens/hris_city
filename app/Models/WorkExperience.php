<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $table = 'work_experiences';
    protected $primaryKey = 'work_ex_id';

    protected $fillable = ['user_id', 
        'work_ex_from', 
        'work_ex_to', 
        'position_title', 
        'department_agency', 
        'salary', 
        'pay_grade', 
        'status_appointment', 
        'is_govt'
    ];

}
