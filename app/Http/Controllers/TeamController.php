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
}
