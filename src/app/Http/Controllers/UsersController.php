<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UsersController extends Controller
{

    public function index()
    {
        $users = DB::table('users')->get();
        return view('users', ['users' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if($user === null) {
            return abort(404);
        }
        return view('user', [
            'id' => $id,
            'user' => $user,
            'authenticated_user_id' => Auth::user()->id,
            'updated' => false
        ]);
    }

    public function update(int $id, Request $request)
    {
        try
        {
            $user = User::find($id);
            if($user === null)
            {
                return abort(404);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->bio = $request->bio;
            $user->save();
            $params = [
                'id' => $id,
                'user' => $user,
                'authenticated_user_id' => Auth::user()->id,
                'updated' => true
            ];
            return json_encode($params);
        }
        catch (Throwable $th)
        {
            throw $th;
        }
    }
}
