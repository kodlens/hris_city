<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBackground extends Model
{
    use HasFactory;


    protected $table = 'educational_backgrounds';
    protected $primaryKey = 'ed_bg_id';


    protected $fillable = [
        'user_id', 
        'level', 
        'name_of_school', 
        'degree', 
        'period_att_from', 
        'period_att_to', 
        'highest_level_unit', 
        'year_graduated', 
        'scholarship'
    ];


}
