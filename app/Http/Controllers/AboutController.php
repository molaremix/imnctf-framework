<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::orderBy('id', 'DESC')->first();
        return view('welcome', compact('about'));
    }
}
