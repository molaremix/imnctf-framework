<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ScoreboardController extends Controller
{
    public function index()
    {
        $scores = DB::select('SELECT teams.name, submissions.team_id, challenges.point FROM submissions INNER JOIN challenges ON submissions.challenge_id = challenges.id INNER JOIN teams ON teams.id=submissions.team_id WHERE submissions.flag = challenges.flag');
        dd($scores);
    }
}
