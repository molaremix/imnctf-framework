<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'title' => 'required|max:64',
            'category' => 'required|max:64',
            'content' => 'required'
        ]);

        $news = new News();
        $news->fill($valid);
        $news->save();

        return redirect()->route('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $valid = $this->validate($request, [
            'title' => 'required|max:64',
            'category' => 'required|max:64',
            'content' => 'required'
        ]);

        $news->fill($valid);
        $news->save();
        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}
