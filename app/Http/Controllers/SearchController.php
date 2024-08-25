<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('nom', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->get();

        $categories = Category::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.results', compact('products', 'categories', 'query'));
    }
}
