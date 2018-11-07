<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\TeamResource;
use App\Http\Resources\TeamUnfreezeResource;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScoreboardController extends Controller
{

    public function index()
    {
        $teams = $this->standing();
        return view('admin.scoreboard', compact('teams'));
    }

    public function standing()
    {
        $teams = Team::where('baned', '0')->get()->sortByDesc(function ($item){
            return $item->pointUnfreeze();
        });
        return TeamUnfreezeResource::collection($teams);
    }
}
