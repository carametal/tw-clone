<?php

namespace App\Http\Controllers;

use App\Models\Tables\Users;
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
        $users = DB::table('users')->get();
        return view('users', ['users' => $users]);
    }

    public function user($id)
    {
        if(Auth::user()->id !== (int) $id)
        {
            return abort(404);
        }
        $updated = false;
        if ($_SERVER["REQUEST_METHOD"] === 'POST')
        {
            $user = new Users();
            $user->update($_POST['name'], $_POST['email'], $_POST['bio']);
            $updated = true;
        }
        return view('user', ['id' => $id, 'user' => Auth::user(), 'updated' => $updated]);
    }
}
