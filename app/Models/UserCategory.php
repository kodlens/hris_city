<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;


    protected $table = 'user_categories';
    protected $primaryKey = 'user_category_id';


    protected $fillable = ['user_id', 'category_id', 'remarks'];


    public function category(){
        return $this->hasOne(Category::class, 'category_id', 'category_id');
    }
}
