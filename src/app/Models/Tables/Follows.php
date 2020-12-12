<?php


namespace App\Models\Tables;


use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\Unit\ExampleTest;

class Follows
{
    public function create(Request $request)
    {
        try {
            $follow = new Follow();
            $follow->user_id = Auth::user()->id;
            $follow->follow_user_id = (int)$request->followUserId;
            $follow->save();
            return $follow;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(Request $request)
    {
        try {
            echo var_dump($request);
            DB::table('follows')
                ->Where('id', '=', $request->followId)
                ->delete();
        } catch (Exception $e){
            throw $e;
        }
    }
}