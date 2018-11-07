<?php

namespace App\Observers;

use App\Models\Team;
use Illuminate\Support\Facades\Hash;

class TeamObserver
{
    public function creating(Team $team)
    {
        $team['password'] = Hash::make($team['password']);
    }
}
