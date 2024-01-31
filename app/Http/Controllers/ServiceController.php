<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ServiceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $services = Service::all();
    $categories = Category::all();
    return view('services')->with([
      'services' => $services,
      'categories' => $categories
    ]);
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $tags = Tag::all(); // Remplacez Tag par le modèle approprié pour les tags
    $categories = Category::all(); // Ajoutez également la récupération des catégories si nécessaire
    $services = Service::all(); //
    return view('admin.services.create', compact('tags', 'categories', 'services'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string',
      'description' => 'required|string',
      'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation pour chaque image
      'categories_id' => 'required|numeric',
      'user_id' => 'required|numeric',
      'tags' => 'nullable|array',
      'tags.*' => 'exists:tags,id',
    ]);

    try {
      // Enregistrez le service dans la base de données
      $service = new Service();
      $service->title = $request->input('title');
      $service->description = $request->input('description');
      $service->slug = Str::slug($request->input('title'));
      $service->categories_id = $request->input('categories_id');
      $service->user_id = Auth::user()->id; // Assurez-vous de stocker l'ID de l'utilisateur
      $service->save();

      // Attachez les tags au service s'ils ont été fournis
      if ($request->has('tags')) {
        $service->tags()->attach($request->input('tags'));
      }

      if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
          $imagePath = $imageFile->store('images', 'public');

          // Enregistrez le chemin de l'image dans la table 'images'
          $image = new Image();
          $image->path = $imagePath;
          $image->service_id = $service->id;
          $image->save();
        }
      }
      // \Illuminate\Support\Facades\Log::info('Le service a été ajouté avec succès.');
      return redirect()->back()->with('success', 'Le service a été ajouté avec succès.');
    } catch (\Exception $e) {
      // \Illuminate\Support\Facades\Log::error('Erreur lors de l\'ajout du service: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'ajout du service.');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Service $service)
  {
    // Vous pouvez passer les données nécessaires à la vue ici
    return view('services.edit', compact('service'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $service = Service::findOrFail($id);
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'categories_id' => 'required|exists:categories,id',
      // Ajoutez ici d'autres champs si nécessaire
    ]);

    try {
      $service->title = $request->input('title');
      $service->description = $request->input('description');
      $service->categories_id = $request->input('categories_id');
      // Mettez à jour ici d'autres champs si nécessaire

      $service->save();

      // Si des tags sont fournis, mettez à jour les tags du service
      if ($request->has('tags')) {
        $service->tags()->sync($request->input('tags'));
      }

      // Si des images sont fournies, mettez à jour les images du service
      if ($request->hasFile('images')) {
        // Supprimez d'abord les anciennes images
        foreach ($service->images as $image) {
          Storage::disk('public')->delete($image->path);
          $image->delete();
        }

        // Ensuite, ajoutez les nouvelles images
        foreach ($request->file('images') as $imageFile) {
          $imagePath = $imageFile->store('images', 'public');

          $image = new Image();
          $image->path = $imagePath;
          $image->service_id = $service->id;
          $image->save();
        }
      }

      dd($service);

      // return redirect()->back()->with('success', 'Le service a été mis à jour avec succès.');
    } catch (\Exception $e) {
      dd($service);

      // return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour du service.');
    }
  }



  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Service $service)
  {
    try {
      // Supprimez le service de la base de données
      $service->delete();

      return redirect()->back()->with('success', 'Le service a été supprimé avec succès.');
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la suppression du service.');
    }
  }

  // public function front(){


  // }
}
