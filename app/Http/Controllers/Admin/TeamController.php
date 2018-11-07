<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin.team.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(TeamRequest $request)
    {
        $validate = $request->validated();
        $validate['verified'] = true;
        Team::create($validate);
        return redirect()->route('admin.team.index');
    }

    public function update(Team $team, Request $request)
    {

    }

    public function edit(Team $team)
    {
        return view('admin.team.create', compact('team'));
    }

    public function hide(Team $team)
    {
        $team->ban();
        return redirect()->route('admin.team.index');
    }

    public function verify(Team $team)
    {
        $team->verify();
        return redirect()->route('admin.team.index');
    }

    public function destroy(Team $team)
    {
        try {
            $team->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.team.index')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.team.index');
    }

}
