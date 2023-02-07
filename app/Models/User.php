<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username', 'lname', 'fname', 'mname', 'suffix', 'sex',
        'bdate',
        'province', 'city', 'barangay', 'street',
        'email', 'contact_no', 'role', 'remark',
        'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function categories(){
        return $this->hasMany(UserCategory::class, 'user_id', 'user_id')
            ->with(['category']);
    }

    public function inline_categories(){
        return $this->hasMany(UserCategory::class, 'user_id', 'user_id')
            ->leftJoin('categories', 'categories.category_id', 'user_categories.category_id');
    }

    public function province(){
        return $this->hasOne(Province::class, 'provCode', 'province');
    }

    public function city(){
        return $this->hasOne(City::class, 'citymunCode', 'city');
    }
    public function barangay(){
        return $this->hasOne(Barangay::class, 'brgyCode', 'barangay');
    }
}
