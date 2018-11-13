<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Models\Challenge;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubmissionController extends Controller
{
    public function store(SubmissionRequest $request)
    {
        $validated = $request->validated();
        $validated['team_id'] = Auth::user()['id'];

        $challenge = Challenge::find($validated['challenge_id']);

        if ($challenge->solved())
            return back()->withErrors(['You have been Solved this Challenge']);

        if ($challenge->remain() == 0)
            return back()->withErrors(['You have exceed your submission limit']);


        $submission = Submission::create($validated);
        if ($submission->correct()) {
            $submission->team->up();
        } else {
            return back()->withErrors('Incorrect');
        }

        Session::flash('status', 'Congratulation your flag is Correct');
        return back();
    }


}
