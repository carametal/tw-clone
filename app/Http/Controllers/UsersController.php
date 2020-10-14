<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $updated = false;
        if ($_SERVER["REQUEST_METHOD"] === 'POST')  {
            Auth::user()->update(['name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'bio' => $_POST['bio']]);
            // DB::table('users')
            //     ->where('id', $id)
            //     ->update(['name' => $_POST['name'],
            //         'email' => $_POST['email'],
            //         'bio' => $_POST['bio']]);
            $updated = true;
        }
        $user = DB::table('users')->where('id', $id)->first();
        if($user === null)
        {
            return abort(404);
        }
        return view('user', ['id' => $id, 'user' => $user, 'updated' => $updated]);
    }

    public function saveUser()
    {
        echo var_dump(['name' => $_POST['name'],
                'email' => $_POST['email'],
                'bio' => $_POST['bio']]);
        return redirect("user/$id");
    }
}