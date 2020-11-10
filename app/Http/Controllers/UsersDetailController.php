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
       $count = DB::table('tweets')
           ->where('user_id', $id)
           ->count('*');
       $follows = DB::table('follows')
           ->where('user_id', $id)
           ->count('*');
       $followers = DB::table('follows')
           ->where('follow_user_id', $id)
           ->count('*');
       $result = [
           'count' => $count,
           'follows' => $follows,
           'followers' => $followers
       ];
       return json_encode($result);
    }

}