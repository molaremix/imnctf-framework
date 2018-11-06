<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('participant.challenge.index', compact(''));
    }

    public function show(Challenge $challenge)
    {
        $hints = $challenge->hint;
        return view('participant.challenge.index', compact('challenge', 'hints'));
    }
}
