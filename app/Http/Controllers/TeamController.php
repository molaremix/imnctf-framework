<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $team = Team::first();
        return view('team.profile.index', compact('team'));
    }

    public function stats(Team $team)
    {
        $submissions = $team->submission()->with('challenge')->get();
        $solved = $submissions->filter(function ($submission) {
            return $submission['flag'] === $submission->challenge['flag'];
        });

        return view('team.stats', compact('solved', 'team', 'submissions'));
    }
}
