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
        $challenges = Challenge::where('is_visible', '1')->where('point_mode', 'dynamic')->get()->pluck('id')->all();
        $bindingChallenges = trim(str_repeat('?,', count($challenges)), ',');
        $bindingTeams = trim(str_repeat('?,', count($teams)), ',');

        $standings = new Collection();
        $points = new Collection();

        /*$solve = new Collection();
        $solve_query = collect(DB::select('SELECT challenge_id, COUNT(*) as solve FROM submissions JOIN challenges ON submissions.challenge_id = challenges.id WHERE submissions.challenge_id IN (' . $bindingChallenges . ') AND submissions.flag = challenges.flag GROUP BY challenge_id', $challenges));
        foreach ($solve_query as $item) {
            $solve->put($item->challenge_id, $item->solve);
        }*/

        Challenge::all()->each(function ($item) use ($points) {
            $points->put($item->id, $item->pts());
        });


        $query = collect(DB::select('SELECT teams.name as team_name, challenges.id as challenge_id FROM submissions JOIN teams on submissions.team_id=teams.id JOIN challenges ON submissions.challenge_id=challenges.id WHERE teams.id IN (' . $bindingTeams . ') and submissions.flag=challenges.flag', $teams))->groupBy('team_name');

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
