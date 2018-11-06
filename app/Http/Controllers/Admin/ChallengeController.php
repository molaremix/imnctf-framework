<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChallengeRequest;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Challenge;
use App\Http\Controllers\Controller;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::all();
        return view('admin.challenge.index', compact('challenges'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.challenge.create', compact('categories'));
    }

    public function store(ChallengeRequest $request)
    {
        $challenge = Challenge::create($request->validated());

        if ($request->has('attachments'))
            foreach ($request->file('attachments') as $file) {
                $fileName = snake_case($file->getClientOriginalName());
                $file->storeAs('attachment', $fileName);
                Attachment::create([
                    'challenge_id' => $challenge['id'],
                    'name' => $fileName,
                ]);
            }

        return redirect()->route('admin.challenge.index');
    }

    public function list()
    {
        CategoryResource::withoutWrapping();
        return CategoryResource::collection(Category::with('challenges')->get());
    }

    public function show(Challenge $challenge)
    {
        return view('admin.challenge.index', compact('challenge'));
    }
}
