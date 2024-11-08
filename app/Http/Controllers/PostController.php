<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
      'tags' => 'nullable|array',
      'tags.*' => 'string|max:255'
    ]);

    // Handle multiple images
    $imagePaths = [];
    if ($request->hasFile('image')) {
      foreach ($request->file('image') as $imageFile) {
        $imagePaths[] = $imageFile->store('images/posts', 'public');
      }
      $validatedData['image'] = json_encode($imagePaths);
    }

    // Add the authenticated user's ID
    $validatedData['user_id'] = auth()->id();

    // Automatically generate a unique slug based on the title
    $validatedData['slug'] = $this->generateUniqueSlug($validatedData['title']);

    // Create the post
    $post = Post::create($validatedData);

    // Handle tags: existing and new
    // $tagIds = [];
    // if ($request->tags) {
    //   foreach ($request->tags as $tag) {
    //     if (is_numeric($tag)) {
    //       // If the tag is an existing tag ID, add it to the list
    //       $tagIds[] = $tag;
    //     } else {
    //       // Otherwise, create a new tag or find an existing one by name
    //       $newTag = Tag::firstOrCreate(['name' => $tag]);
    //       $tagIds[] = $newTag->id;
    //     }
    //   }
    // }
    // $post->tags()->sync($tagIds);

    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
  }

  // Helper method to generate a unique slug
  private function generateUniqueSlug($title)
  {
    $slug = Str::slug($title);
    $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
    return $count ? "{$slug}-{$count}" : $slug;
  }


  public function show($slug)
  {
    $post = Post::where('slug', $slug)->with('tags', 'user')->firstOrFail();
    $recentPosts = Post::latest()->limit(3)->get();
    $categories = Category::all();

    return view('blogs.show', compact('post', 'recentPosts', 'categories'));
  }
  public function post()
  {
    $posts = Post::orderBy('id', 'desc')->paginate(10);
    $categories = Category::all();

    return view('blogs.index', compact('posts', 'categories'));
  }

  public function edit($id)
  {
    $post = Post::with('user')->findOrFail($id);
    // $tags = Tag::all();
    return view('admin.blogs.edit', compact('post'));
  }
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'title' => 'required',
      'details' => 'nullable',
      'description' => 'required',
      'image.*' => 'nullable|image',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id',
    ]);

    $post = Post::findOrFail($id);

    // Update fields
    $post->title = $validatedData['title'];
    $post->details = $validatedData['details'];
    $post->description = $validatedData['description'];

    // Handle image uploads if provided
    if ($request->hasFile('image')) {
      $images = [];
      foreach ($request->file('image') as $imageFile) {
        $path = $imageFile->store('public/images/posts');
        $images[] = str_replace('public/', '', $path);
      }
      $post->image = json_encode($images);
    }

    // Save the post
    $post->save();

    // Sync tags
    // $post->tags()->sync($validatedData['tags'] ?? []);

    return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
  }
  public function destroy($id)
  {
    $post = Post::findOrFail($id);
    $post->delete();

    return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');
  }
}
