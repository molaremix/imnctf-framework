<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $news = News::all()->sortKeysDesc();
        return view('admin.news.index', compact('news'));
    }

    public function store(NewsRequest $request)
    {
        News::create($request->validated());
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

    public function update(NewsUpdateRequest $request, News $news)
    {
        $news->fill($request->validated());
        $news->save();
        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index');
    }
}
