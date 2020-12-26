<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfilesControler extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (Auth::user()->id === $id)
        {
            return view('user_profile', [
                'id' => $id,
                'user' => User::find($id),
            ]);
        }
        return abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
