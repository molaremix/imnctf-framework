<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $about = Challenge::all();
        return view('participant.challenge.index', compact('about', 'more'));
    }
}
