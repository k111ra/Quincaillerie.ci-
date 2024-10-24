<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;


class TagController extends Controller
{
  /**
   * Affiche une liste de tous les tags.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    $tags = Tag::all();
    return view('admin.tags.index', compact('tags'));
  }

  /**
   * Affiche le formulaire pour créer un nouveau tag.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('admin.tags.create');
  }

  /**
   * Enregistre un nouveau tag dans la base de données.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255|unique:tags',
    ]);

    $tag = new Tag();
    $tag->name = $validatedData['name'];
    $tag->slug = Str::slug($request->name);
    $tag->save();

    return redirect()->route('admin.tags.index')->with('success', 'Le tag a été créé avec succès.');
  }

  /**
   * Affiche le formulaire pour modifier un tag existant.
   *
   * @param  int  $id
   * @return \Illuminate\View\View
   */
  public function edit($id)
  {
    $tag = Tag::findOrFail($id);
    return view('admin.tags.edit', compact('tag'));
  }

  /**
   * Met à jour un tag existant dans la base de données.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255|unique:tags,name,' . $id,
    ]);

    $tag = Tag::findOrFail($id);
    $tag->name = $validatedData['name'];
    $tag->save();

    return redirect()->route('admin.tags.index')->with('success', 'Le tag a été mis à jour avec succès.');
  }

  /**
   * Supprime un tag de la base de données.
   *
   * @param  int  $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    $tag = Tag::findOrFail($id);
    $tag->delete();

    return redirect()->route('admin.tags.index')->with('success', 'Le tag a été supprimé avec succès.');
  }
}
