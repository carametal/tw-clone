<?php

namespace App\Http\Controllers;

use App\Models\FollowList\FollowListMaker;
use Illuminate\Http\Request;

class FollowListController extends Controller
{
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
        return $follow_list->follows;
    }
}
