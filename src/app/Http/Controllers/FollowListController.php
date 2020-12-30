<?php

namespace App\Http\Controllers;

use App\Models\FollowList\FollowListMaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowListController extends Controller
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
        $maker = new FollowListMaker();
        $follow_list = $maker->get($id);
        return view('follow_list', [
            'login_user' => Auth::user(),
            'follows' => $follow_list->follows
        ]);
    }
}
