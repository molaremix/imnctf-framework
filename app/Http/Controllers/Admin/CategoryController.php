<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        $categories = Category::all();
        return view('admin.category.index', compact('category', 'categories'));
    }

    public function update(Category $category, CategoryRequest $request){
        $category->fill($request->validated());
        $category->save();
        return redirect()->route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.category.index')->withErrors($e->getMessage());
        }
        return redirect()->route('admin.category.index');
    }
}
