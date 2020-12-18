<?php

namespace App\Http\Controllers;

use App\Models\Timeline\TimelineMaker;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function show(int $id, Request $request)
    {
        try {
            $timeline_maker = new TimelineMaker($id);
            $timeline = $timeline_maker->make($request);
            return json_encode($timeline->get_tweets());
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
