<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

  public function index(Request $request)
  {
    // Get search keyword from request
    $search = $request->input('search');

    // Query posts based on search keyword or show all posts if no search is provided
    $posts = Post::with('user')
      ->when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%")
          ->orWhere('description', 'like', "%{$search}%");
      })
      ->paginate(10);

    return view('admin.blogs.index', compact('posts', 'search'));
  }


  public function create()
  {
    $tags = Tag::all();
    return view('admin.blogs.create', compact('tags'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'details' => 'required',
      'description' => 'required',
      'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Gestion des images multiples
    $imagePaths = [];
    if ($request->hasFile('image')) {
      foreach ($request->file('image') as $imageFile) {
        $imagePaths[] = $imageFile->store('images/posts', 'public');
      }
      $validatedData['image'] = json_encode($imagePaths);
    }

    // Ajouter l'ID de l'utilisateur authentifié
    $validatedData['user_id'] = auth()->id();

    // Créer le post
    $post = Post::create($validatedData);

    // // Gérer les tags : nouveaux et existants
    // $tagIds = [];
    // if ($request->tags) {
    //   foreach ($request->tags as $tag) {
    //     if (is_numeric($tag)) {
    //       $tagIds[] = $tag;
    //     } else {
    //       $newTag = Tag::firstOrCreate(['name' => $tag]);
    //       $tagIds[] = $newTag->id;
    //     }
    //   }
    // }
    // $post->tags()->sync($tagIds);

    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
  }

  public function show($id)
  {
    $post = Post::with('user')->findOrFail($id);
    // $post = Post::with('tags', 'user')->findOrFail($id); // Include relationships

    $recentPosts = Post::latest()->limit(3)->get();      // Get 3 recent posts for the sidebar
    $categories = Category::all();                       // Assuming you have a Category model

    return view('blogs.show', compact('post', 'recentPosts', 'categories'));
  }
}
