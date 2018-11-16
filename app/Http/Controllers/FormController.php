<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function form()
    {
        return view('form.openmind');
    }

    public function flag()
    {
        highlight_file('flag.txt');
    }
}
