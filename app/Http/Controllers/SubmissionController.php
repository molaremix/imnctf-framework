<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionRequest;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubmissionController extends Controller
{
    public function store(SubmissionRequest $request)
    {
        $validated = $request->validated();
        $validated['team_id'] = Auth::user()['id'];

        $submission = Submission::create($validated);
        if (!$submission->correct()) {
            return back()->withErrors('Incorrect');
        }
        Session::flash('status', 'Congratulation your flag is Correct');
        return back();
    }


}
