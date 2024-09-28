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
    return view('admin.categories.index', compact('parents', 'categories'));
  }

  public function create()
  {
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    return view('admin.categories.create', compact('parents')); // Changer vers la vue de création
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

  public function edit(Category $category)
  {
    $parents = Category::pluck('name', 'id')->prepend('None', '');
    $categories = Category::all();
    return view('admin.categories.edit', compact('category', 'parents', 'categories'));
  }

  public function update(Request $request, Category $category)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'description' => 'nullable|max:255',
      'parent_id' => 'nullable|exists:categories,id',
    ]);

    $category->update($validatedData);
    return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
  }

  public function destroy(Category $category)
  {
    // Optionnel : Vérifier les enfants avant suppression
    // if ($category->children()->count() > 0) {
    //     return redirect()->route('admin.categories.index')->with('error', 'Cannot delete category with children');
    // }

    $category->delete();
    return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
  }
}
