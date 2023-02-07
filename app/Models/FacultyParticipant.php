<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyParticipant extends Model
{
    use HasFactory;



    protected $table = 'faculty_participants';
    protected $primaryKey = 'faculty_participant_id';


    protected $fillable = [
        'seminar_post_id',
        'teacher_id',
        'lname',
        'fname',
        'mname',
        'sex',
        'specialization',
        'title',
        'remarks'
    ];


}
