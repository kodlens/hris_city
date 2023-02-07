<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedTeacherList extends Model
{
    use HasFactory;

    protected $table = 'recommended_teacher_lists';
    protected $primaryKey = 'recommended_teacher_list_id';

    protected $fillable = [
        'recommended_teacher_id', 'teacher_id', 'lname',
        'fname', 'mname', 'sex', 'specialization', 'no_seminars'
    ];


}
