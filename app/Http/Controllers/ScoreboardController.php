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
        $challenges = Challenge::where('is_visible', '1')->where('point_mode', 'dynamic')->get()->pluck('id')->all();
        $bindingChallenges = trim(str_repeat('?,', count($challenges)), ',');
        $points = new Collection();
        $solve_query = collect(DB::select('SELECT submissions.challenge_id, challenges.decay as decay, challenges.minimum as minimum, challenges.point as point, COUNT(*) as solve FROM submissions JOIN challenges ON submissions.challenge_id = challenges.id WHERE submissions.challenge_id IN (' . $bindingChallenges . ') AND submissions.flag = challenges.flag GROUP BY submissions.challenge_id, submissions.challenge_id, challenges.decay, challenges.minimum, challenges.point', $challenges));
        foreach ($solve_query as $item) {
            $points->put($item->challenge_id, $this->pts($item->decay, $item->minimum, $item->point, $item->solve));
        }

        $submissions = Submission::with('challenge')->get();
        $filteredSubmission = $submissions->filter(function ($submission) {
            return $submission['flag'] === $submission->challenge['flag'];
        });

        $maps = $filteredSubmission->mapWithKeys(function ($submission) {
            return [
                $submission['team_id'] . '#' . $submission['challenge_id'] => $submission
            ];
        })->groupBy('challenge_id');

        $teams = $maps->map(function ($submissions) {
            return $submissions->sortBy('created_at')->map(function ($submission, $position) {
                $submission['position'] = $position + 1;
                return $submission;
            });
        })->collapse()->groupBy('team_id')->map(function ($submissions) {
            return $submissions->pluck('position', 'challenge_id');
        });

        $allTeam = Team::where('baned', '0')->get();

        $standings = new Collection();
        foreach ($teams as $key => $value) {
            $standings->put($value->map(function ($item, $i) use ($points) {
                return $points->get($i) - $item;
            })->sum(), $allTeam->find($key));
        }
        $results = $standings->all();
        krsort($results);

        return view('scoreboards', compact('results'));
    }

    public function pts($decay, $minimum, $point, $solve)
    {
        $dynamic = ceil(((($minimum - $point) / ($decay ** 2)) * (($solve) ** 2)) + $point);
        return $dynamic < $minimum ? $minimum : $dynamic;
    }
}
