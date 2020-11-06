<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class TweetsDetailController extends Controller
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
           'count' => $userDetail
       ];
       return json_encode($result);
    }

}