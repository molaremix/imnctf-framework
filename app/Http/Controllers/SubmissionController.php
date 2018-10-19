<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function strore(Request $request)
    {
        $submission = new Submission();
        $submission->fill($request->all());
        return view('participant.scoreboard.index', compact('submission'));
    }
}
