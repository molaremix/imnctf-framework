<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ChallengeRequest;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Challenge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function update(Challenge $challenge, Request $request)
    {
        Validator::make($request->all(), [
            'flag' => [
                'required',
                Rule::unique('challenges')->ignore($challenge->id),
            ],
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:32',
            'description' => 'required',
            'point' => 'required|numeric',
            'submission_limit' => 'required|numeric',
            'visible' => 'required',
            'point_mode' => 'in:static,decrease,attack_defense',
            'attachments' => 'nullable',
            'attachments.*' => 'mimes:zip|max:2000'
        ]);

        if ($request->has('attachments'))
            foreach ($request->file('attachments') as $file) {
                $fileName = snake_case($file->getClientOriginalName());
                $file->storeAs('attachment', $fileName);
                Attachment::create([
                    'challenge_id' => $challenge['id'],
                    'name' => $fileName,
                ]);
            }

        $challenge->fill($request->all());
        $challenge->save();
        return redirect()->route('admin.challenge.index');

    }

    public function list()
    {
        CategoryResource::withoutWrapping();
        return CategoryResource::collection(Category::with('challenges')->get());
    }

    public function edit(Challenge $challenge)
    {
        $categories = Category::all();
        return view('admin.challenge.edit', compact('challenge', 'categories'));
    }

    public function destroy(Challenge $challenge)
    {
        try {
            $challenge->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.challenge.index')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.challenge.index');
    }
}
