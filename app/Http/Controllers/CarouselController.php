<?php

namespace App\Http\Controllers;

use App\Http\Controllers\user_interface\Carousel as User_interfaceCarousel;
use Illuminate\Http\Request;
use App\Models\Carousel;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
  /**
   * Affiche la liste des carrousels
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $carousels = Carousel::all();
    return view('admin.slider.index', compact('carousels'));
  }

  /**
   * Affiche le formulaire de création d'un carousel
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.slider.create');
  }

  /**
   * Enregistre un nouveau carousel
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $carousel = new Carousel();

    $carousel->title = $validated['title'];
    $carousel->description = $validated['description'];

    $path = $request->file('image')->store('public/images/carousels');
    $carousel->image = str_replace('public/', '', $path);

    $carousel->save();

    return redirect()->route('admin.slider.index')
      ->with('success', 'Carousel created successfully');
  }

  /**
   * Affiche le formulaire d'édition d'un carousel
   *
   * @param  \App\Models\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function edit(Carousel $carousel)
  {
    return view('admin.slider.edit', compact('carousel'));
  }

  /**
   * Met à jour les informations d'un carousel
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $carousel = Carousel::findOrFail($id);
    $carousel->title = $validatedData['title'];
    $carousel->description = $validatedData['description'];

    if ($request->hasFile('image')) {
      // Delete the old image from storage
      Storage::delete('public/images/' . $carousel->image);

      // Save the new image
      $imagePath = $request->file('image')->store('public/images');
      $carousel->image = str_replace('public/', '', $imagePath);
    }

    $carousel->save();

    return redirect()->route('admin.slider.index')
      ->with('success', 'Carousel updated successfully');
  }

  /**
   * Supprime un carousel de la base de données
   *
   * @param  \App\Models\Carousel  $carousel
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $carousel = Carousel::findOrFail($id);
    $carousel->delete();

    return redirect()->route('admin.slider.index')
      ->with('success', 'Carousel deleted successfully');
  }
}
