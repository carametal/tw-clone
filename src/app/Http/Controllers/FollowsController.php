<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    const ERROR_FOLLOWED = [
        'code' => 1,
        'message' => 'already followed.'
    ];
    const ERROR_FOLLOW_IS_NOT_EXITS = [
        'code' => 2,
        'message' => 'follow is not exists.'
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        return json_encode(['follow' => Follow::factory()->create([
            'user_id' => $request->userId,
            'follow_user_id' => $request->followUserId,
        ])]);
    }

    public function destroy($id)
    {
        $follow = Follow::find($id);
        $follow->delete();
    }
}