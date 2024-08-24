<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class LoginPageController extends Controller
{
    public function admin()
    {
      $categories = Category::with('children')
        ->whereNull('parent_id') // récupérer seulement les catégories qui n'ont pas de parent
        ->get();
      return View('admin.login')->with('categories', $categories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
      $categories = Category::with('children')
        ->whereNull('parent_id') // récupérer seulement les catégories qui n'ont pas de parent
        ->get();
       return view('user.login')->with('categories', $categories);
    }

}
