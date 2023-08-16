<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function index(){
      $categories = Category::all();
      return view('contact')->with([
        "categories" => $categories
      ]);
    }
}
