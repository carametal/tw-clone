<?php

namespace App\Models\Tables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Users
{
    public function update($name, $email, $bio)
    {
        $user = Auth::user();
        $user->name = $name;
        $user->email = $email;
        $user->bio = $bio;
        $user->save();
    }
}
