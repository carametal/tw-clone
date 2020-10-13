<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = DB::select('select * from users');
        return view('users', ['users' => $users]);
    }

    public function user($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('user', ['user' => $user]);
    }

}