<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CivilStatus extends Model
{
    use HasFactory;

    protected $table = 'civil_statuses';
    protected $primaryKey = 'id';


    protected $fillable = ['civil_status'];
}
