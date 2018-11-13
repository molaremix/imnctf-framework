<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HintRequest;
use App\Models\Challenge;
use App\Models\Hint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HintController extends Controller
{
    public function index()
    {
        $hints = Hint::with('challenge')->get();
        $challenges = Challenge::all();
        return view('admin.hint.index', compact('hints', 'challenges'));
    }

    public function store(HintRequest $request)
    {
        Hint::create($request->validated());
        return redirect()->route('admin.hint.index');
    }

    public function edit(Hint $hint)
    {
        $hints = Hint::all();
        return view('admin.hint.index', compact('hint', 'hints'));
    }

    public function update(Hint $hint, HintRequest $request){
        $hint->fill($request->validated());
        $hint->save();
        return redirect()->route('admin.hint.index');
    }

    public function destroy(Hint $hint)
    {
        try {
            $hint->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.hint.index')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.hint.index');
    }
}
