<?php

namespace Modules\Evaluation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;


    protected static function newFactory()
    {
        return \Modules\Evaluation\Database\factories\StudentFactory::new();
    }
}
