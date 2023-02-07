<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDevelopmentType extends Model
{
    use HasFactory;


    protected $table = 'learning_development_types';
    protected $primaryKey = 'ld_type_id';


    protected $fillable = [
        'ld_type'
    ];

}
