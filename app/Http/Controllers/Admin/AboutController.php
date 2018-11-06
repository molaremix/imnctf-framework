<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutRequest;
use App\Models\About;
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

    public function store(AboutRequest $request)
    {
        About::create($request->validated());
        return redirect()->route('about.index');
    }

    public function welcome()
    {
        $about = About::orderBy('id', 'DESC')->first();
        return view('welcome', compact('about'));
    }
}
