<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeminarPost extends Model
{
    use HasFactory;

    protected $table = 'seminar_posts';
    protected $primaryKey = 'seminar_post_id';


    protected $fillable = [
        'title', 'seminar_date',
        'ld_type', 'skills', 'conducted_by',
        'cpd_units', 'no_hours',
        'specialization',
        'img_path', 'description', 'date_posted'
    ];




}
