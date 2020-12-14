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

    public function store(Request $request)
    {
        $follows = new Follows();
        return json_encode(['follow' => $follows->create($request)]);
    }

    public function destroy($id)
    {
        $follows = new Follows();
        $follows->delete($id);
    }
}