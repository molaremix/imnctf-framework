<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Submission;
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
        $solve_query = collect(DB::select('SELECT submissions.challenge_id, challenges.decay as decay, challenges.minimum as minimum, challenges.point as point, COUNT(*) as solve FROM submissions JOIN challenges ON submissions.challenge_id = challenges.id WHERE submissions.challenge_id IN (' . $bindingChallenges . ') AND submissions.flag = challenges.flag GROUP BY submissions.challenge_id, submissions.challenge_id, challenges.decay, challenges.minimum, challenges.point', $challenges));
        foreach ($solve_query as $item) {
            $points->put($item->challenge_id, [
                'pts' => $this->pts($item->decay, $item->minimum, $item->point, $item->solve)
            ]);
        }

        $query = collect(DB::select('SELECT teams.name as team_name, challenges.id as challenge_id FROM submissions JOIN teams on submissions.team_id=teams.id JOIN challenges ON submissions.challenge_id=challenges.id WHERE teams.id IN (' . $bindingTeams . ') and submissions.flag=challenges.flag', $teams))->groupBy('team_name');
        foreach ($query as $key => $item) {
            $standings->put($key, $item->map(function ($item) use ($points) {
                return $points->get($item->challenge_id);
            })->sum('pts'));
        }

        $standings = $standings->all();
        arsort($standings);

        return view('scoreboard', compact('standings'));
    }

    public function standing()
    {
        $submissions = Submission::with('challenge')->get();
        $filteredSubmission = $submissions->filter(function ($submission) {
            return $submission['flag'] === $submission->challenge['flag'];
        });

        $maps = $filteredSubmission->mapWithKeys(function ($submission) {
            return [
                $submission['team_id'] . '#' . $submission['challenge_id'] => $submission
            ];
        })->groupBy('challenge_id');

        $points = $maps->map(function ($submissions) {
            return $submissions->sortBy('created_at')->map(function ($submission, $position) {
                $submission['position'] = $position + 1;

                return $submission;
            });
        })->collapse()->groupBy('team_id')->map(function ($submissions) {
            return $submissions->pluck('position', 'challenge_id');
        });
        return $points;
    }

    public function pts($decay, $minimum, $point, $solve)
    {
        $dynamic = ceil(((($minimum - $point) / ($decay ** 2)) * (($solve) ** 2)) + $point);
        return $dynamic < $minimum ? $minimum : $dynamic;
    }
}
