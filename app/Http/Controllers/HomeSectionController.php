<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeSection;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeSectionController extends Controller
{
    /**
     * Liste des sections de la page d'accueil.
     */
    public function index()
    {
        $sections = HomeSection::orderBy('position')->orderBy('id')->get();

        return view('admin.home_sections.index', compact('sections'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('admin.home_sections.create', [
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Enregistre une nouvelle section.
     */
    public function store(Request $request)
    {
        $validated = $this->validateSection($request);

        HomeSection::create($validated);

        return redirect()->route('admin.home-sections.index')
            ->with('success', 'Section ajoutée avec succès.');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit(HomeSection $home_section)
    {
        return view('admin.home_sections.edit', [
            'section' => $home_section,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Met à jour une section.
     */
    public function update(Request $request, HomeSection $home_section)
    {
        $validated = $this->validateSection($request);

        $home_section->update($validated);

        return redirect()->route('admin.home-sections.index')
            ->with('success', 'Section mise à jour avec succès.');
    }

    /**
     * Active / désactive rapidement une section.
     */
    public function toggle(HomeSection $home_section)
    {
        $home_section->update(['is_active' => ! $home_section->is_active]);

        return back()->with('success', 'Statut de la section mis à jour.');
    }

    /**
     * Supprime une section.
     */
    public function destroy(HomeSection $home_section)
    {
        $home_section->delete();

        return redirect()->route('admin.home-sections.index')
            ->with('success', 'Section supprimée.');
    }

    /**
     * Validation partagée création / édition, avec vérification que la source existe.
     */
    private function validateSection(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type' => 'required|in:category,tag',
            'source_id' => 'required|integer',
            'display' => 'required|in:grid,slider,tabs',
            'limit' => 'required|integer|min:1|max:50',
            'position' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // La source doit exister dans la table correspondant au type choisi.
        $validator->after(function ($validator) use ($request) {
            $sourceExists = $request->input('type') === 'tag'
                ? Tag::whereKey($request->input('source_id'))->exists()
                : Category::whereKey($request->input('source_id'))->exists();

            if (! $sourceExists) {
                $validator->errors()->add('source_id', 'La source sélectionnée est introuvable.');
            }
        });

        $validated = $validator->validate();

        $validated['position'] = $validated['position'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
