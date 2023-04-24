<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        $parents = Category::pluck('name', 'id')->prepend('None', '');
        return view('admin.categories.index', ['parents' => $parents], ['categories' => $categories]);
    }

    public function create()
    {
      $categories = Category::with('parent')->get();
      $parents = Category::pluck('name', 'id')->prepend('None', '');
      return view('admin.categories.index', ['parents' => $parents], ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }


    public function edit(Category $category)
    {
        $parents = Category::pluck('name', 'id')->prepend('None', '');
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}

