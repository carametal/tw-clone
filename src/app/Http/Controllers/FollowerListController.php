<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowerListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $followers = Follow::where('follow_user_id', $id)->get();
        return view('follower_list', [
            'followers' => $followers,
            'login_user' => Auth::user()
        ]);
    }
}
