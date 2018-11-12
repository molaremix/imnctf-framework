<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ScoreboardController extends Controller
{
    public function index()
    {
        $teams = Team::where('baned', '0')->get()->pluck('id')->all();
        $standings = new Collection();
        $points = new Collection();
        Challenge::all()->each(function ($item) use ($points) {
            $points->put($item->id, $item->pts());
        });

        $bindingsString = trim(str_repeat('?,', count($teams)), ',');
        $query = collect(DB::select('SELECT teams.name as team_name, challenges.id as challenge_id FROM submissions JOIN teams on submissions.team_id=teams.id JOIN challenges ON submissions.challenge_id=challenges.id WHERE teams.id IN (' . $bindingsString . ') and submissions.flag=challenges.flag', $teams))->groupBy('team_name');

        foreach ($query as $key => $item) {
            $standings->put($key, $item->map(function ($item) use ($points) {
                return $points->get($item->challenge_id);
            })->sum());
        }

        $standings = $standings->all();
        arsort($standings);

        return view('scoreboard', compact('standings'));
    }
}
