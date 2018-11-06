<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $submission = new Submission();
        $submission->fill($request->all());
        return view('team.scoreboard.index', compact('submission'));
    }


}
