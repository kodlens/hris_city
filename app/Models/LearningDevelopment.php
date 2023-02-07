<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDevelopment extends Model
{
    use HasFactory;

    protected $table = 'learning_developments';
    protected $primaryKey = 'learning_dev_id';


    protected $fillable = [
        'user_id',
        'title_learning_dev',
        'date_from',
        'date_to',
        'no_hours',
        'type_ld',
        'sponsored_by',
        'attach_path'
    ];



    public function certificates(){
        return $this->hasMany(Certificate::class, 'learning_dev_id', 'learning_dev_id');
    }

}
