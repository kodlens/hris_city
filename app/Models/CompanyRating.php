<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRating extends Model
{
    use HasFactory;

    protected $table = 'company_ratings';
    protected $primaryKey = 'company_rating_id';

    protected $fillable = [
        'company_id', 'user_id',
        'job_post_id', 'rating',
    ];


}
