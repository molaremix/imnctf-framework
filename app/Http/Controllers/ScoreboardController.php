<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class ScoreboardController extends Controller
{
    public function index()
    {
        $teams = $this->standing();
        return view('scoreboard', compact('teams'));
    }

    public function standing()
    {
        $teams = Team::where('baned', '0')->get()->sortByDesc(function ($item){
            return $item->point();
        });
        return TeamResource::collection($teams);
    }
}
