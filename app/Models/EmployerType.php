<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerType extends Model
{
    use HasFactory;

    protected $table = 'employer_types';
    protected $primaryKey = 'employer_type_id';

    protected $fillable = ['public_private', 'employer_type'];


}
