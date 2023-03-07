<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedTeacher extends Model
{
    use HasFactory;

    protected $table = 'recommended_teachers';
    protected $primaryKey = 'recommended_teacher_id';

    protected $fillable = ['seminar_post_id', 'seminar_title', 'remarks'];


    public function recommended_teacher_lists(){
        return $this->hasMany(RecommendedTeacherList::class, 'recommended_teacher_id', 'recommended_teacher_id')
            ->orderBy('lname', 'asc');
    }

    public function seminar(){
        return $this->hasOne(SeminarPost::class, 'seminar_post_id', 'seminar_post_id');

    }
}
