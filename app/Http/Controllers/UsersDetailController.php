<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class UsersDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(int $id)
    {
       $userDetail = DB::table('tweets')
           ->groupBy('user_id')
           ->where('user_id', $id)
           ->count('*');
       $result = [
           'count' => $userDetail,
           'follows' => 0,
           'followers' => 0
       ];
       return json_encode($result);
    }

}