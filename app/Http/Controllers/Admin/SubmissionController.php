<?php

namespace App\Http\Controllers\Admin;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::all()->sortByDesc('created_at');
        return view('admin.submission.index', compact('submissions'));
    }
}
