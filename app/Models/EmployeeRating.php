<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRating extends Model
{
    use HasFactory;

    protected $table = 'employee_ratings';
    protected $primaryKey = 'employee_rating_id';

    protected $fillable = [
       'user_id', 'applicant_id', 'job_post_id', 'rating',
    ];


}
