<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;


    protected $table = 'children';
    protected $primaryKey = 'child_id';


    protected $fillable = ['user_id', 'fullname', 'child_bdate'];


}
