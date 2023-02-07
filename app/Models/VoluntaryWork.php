<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoluntaryWork extends Model
{
    use HasFactory;


    protected $table = 'voluntary_works';
    protected $primaryKey = 'voluntary_work_id';


    protected $fillable = [
        'user_id', 
        'name_address_org', 
        'work_from', 
        'work_to', 
        'no_hours', 
        'nature_work'
    ];

}
