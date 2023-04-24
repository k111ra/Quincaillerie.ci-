<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function index()
  {
        $categories = Category::with('children')
        ->whereNull('parent_id') // récupérer seulement les catégories qui n'ont pas de parent
        ->get();
    return view('index', compact('categories'));
  }
}
