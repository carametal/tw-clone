<?php


namespace App\Http\Controllers;


use App\Models\Tables\Follows;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function follow(Request  $request)
    {
        $follows = new Follows();
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $follows->create($request);
        }
        else if($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {
            $follows->delete($request);

        }
    }

}