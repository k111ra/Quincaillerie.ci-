<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
      $categories = Category::with('parent')->get();
      $parents = Category::pluck('name', 'id')->prepend('None', '');
      return view('user.dashboard')->with([
        'categories' => $categories,

      ]);
    }
}
