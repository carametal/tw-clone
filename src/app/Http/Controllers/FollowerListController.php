<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\FollowerList\FollowerListMaker;
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
        $maker = new FollowerListMaker();
        $follower_list = $maker->get($id);
        return view('follower_list', [
            'followers' => $follower_list->followers,
            'login_user' => Auth::user()
        ]);
    }
}
