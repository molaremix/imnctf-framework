<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $about = About::orderBy('id', 'DESC')->first();
        return view('admin.about.index', compact('about'));
    }

    public function store(Request $request)
    {

        $valid = $this->validate($request, [
            'title' => 'required|max:64',
            'description' => 'required',
            'start' => 'required|date',
            'finish' => 'required|date|after:start',
            'freeze' => 'required|integer|min:0'
        ]);

        $about = new About();
        $about->fill($valid);
        $about->save();

        return redirect()->route('about.index');
    }

    public function welcome()
    {
        $about = About::orderBy('id', 'DESC')->first();
        return view('welcome', compact('about'));
    }
}
