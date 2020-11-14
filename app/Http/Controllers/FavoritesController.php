<?php

namespace App\Http\Controllers;

use App\Models\Rests\Favorites;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $favorites = new Favorites();
            return json_encode(['favorite' => $favorites->create($request)]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $favorites = new Favorites();
            return json_encode(['favorite' => $favorites->delete($id)]);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
