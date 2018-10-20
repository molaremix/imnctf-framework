<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Challenge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class ChallengeController extends Controller
{
    public function index()
    {
        return view('admin.challenge.index');
    }

    public function create()
    {
        return view('admin.challenge.create');
    }
}
