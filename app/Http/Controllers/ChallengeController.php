<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Challenge;
use Carbon\Carbon;

class ChallengeController extends Controller
{
    public function index()
    {
        $about = About::orderBy('id', 'DESC')->first();
        if ($about != null){
            $started = Carbon::now() > $about->start;
            $finished = Carbon::now() > $about->finish;
        }else{
            $started = false;
            $finished = false;
        }

        return view('team.challenge.index', compact('started', 'finished'));
    }

    public function show(Challenge $challenge)
    {
        $hints = $challenge->hint;
        $about = About::orderBy('id', 'DESC')->first();
        $started = Carbon::now() > $about->start;
        $finished = Carbon::now() > $about->finish;

        return view('team.challenge.index', compact('challenge', 'hints', 'started', 'finished'));
    }
}
