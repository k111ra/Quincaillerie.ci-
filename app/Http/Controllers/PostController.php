<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::all();

    return view('admin.blogs.index', compact('posts'));
  }

  public function create()
  {
    return view('admin.blogs.create-post');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required',
      'content' => 'required',
      'image' => 'nullable|image',
    ]);

    // Upload and store the image if provided
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('images/posts');
      $validatedData['image'] = $imagePath;
    }

    Post::create($validatedData);

    return redirect()->route('admin.posts.store')->with('success', 'Post created successfully');
  }


}
