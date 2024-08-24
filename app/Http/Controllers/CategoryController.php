<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'description' => 'nullable|max:255',
      'parent_id' => 'nullable|exists:categories,id',
    ]);

    $category = new Category();
    $category->name = $validatedData['name'];
    $category->parent_id = $request->input('parent_id');
    $category->description = $request->input('description');
    $category->slug = Str::slug($request->input('name'));
    $category->save();

    return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
  }

  // public function show(Category $category)
  // {
  //   $categories = Category::with('parent')->get();
  //   $parents = Category::pluck('name', 'id')->prepend('None', '');

  //   return view('shop', [
  //     'parents' => $parents,
  //     'categories' => $categories,
  //     'category' => $category
  //   ]);
  // }


  public function edit(Category $category)
  {
    $categories = Category::all();
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    return view('admin.categories.edit', compact('category', 'parents', 'categories'));
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
