<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Models\About;
use App\Models\Team;
use Illuminate\Support\Carbon;

class ScoreboardController extends Controller
{
    public function index()
    {
        $teams = $this->standing();
        $about = About::orderBy('id', 'DESC')->first();
        if ($about != null)
            $freeze = Carbon::now() > $about->finish->subHours(4);
        else
            $freeze = Carbon::now();

        return view('scoreboard', compact('teams', 'freeze'));
    }

    public function standing()
    {
        $teams = Team::where('baned', '0')->get()->sortByDesc(function ($item) {
            return $item->point();
        });
        return TeamResource::collection($teams);
    }
}
