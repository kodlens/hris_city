<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherInformation extends Model
{
    use HasFactory;

    
    protected $table = 'other_informations';
    protected $primaryKey = 'other_info_id';


    protected $fillable = [
        'user_id',
        'skill_hobbies',
        'non_academic_distinction', 
        'member_association', 
    ];

}
