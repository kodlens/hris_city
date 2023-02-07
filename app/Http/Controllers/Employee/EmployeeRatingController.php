<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeRating;
use Auth;

class EmployeeRatingController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function getEmployeeRating($user_id){

        $data = EmployeeRating::select('*')
            ->addSelect(['total_rating' => function ($q) use ($user_id){
                $q->selectRaw('sum(rating)')
                ->from('employee_ratings')
                ->where('user_id', $user_id);
            }])
            ->addSelect(['total_raters' => function ($q) use ($user_id){
                $q->selectRaw('count(*)')
                ->from('employee_ratings')
                ->where('user_id', $user_id);
            }])
           ->selectRaw('(select(total_rating) / (select count(*) from employee_ratings where user_id = ?)) as user_total_rating', [$user_id])
            ->where('user_id', $user_id)
            ->get();

        return $data;
    }


    public function getMyRating(){
        $user = Auth::user();
        $user_id = $user->user_id;

        $data = EmployeeRating::select('*')
            ->addSelect(['total_rating' => function ($q) use ($user_id){
                $q->selectRaw('sum(rating)')
                ->from('employee_ratings')
                ->where('user_id', $user_id);
            }])
            ->addSelect(['total_raters' => function ($q) use ($user_id){
                $q->selectRaw('count(*)')
                ->from('employee_ratings')
                ->where('user_id', $user_id);
            }])
           ->selectRaw('(select(total_rating) / (select count(*) from employee_ratings where user_id = ?)) as user_total_rating', [$user_id])
            ->where('user_id', $user_id)
            ->first();

        return $data;
    }

}
