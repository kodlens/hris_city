<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilServiceEligibility extends Model
{
    use HasFactory;


    protected $table = 'civil_service_eligibilities';
    protected $primaryKey = 'cse_id';


    protected $fillable = ['user_id',
        'career_exam',
        'rating',
        'date_exam',
        'place_exam',
        'license_no',
        'license_validity'
    ];


}
