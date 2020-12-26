<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
}
