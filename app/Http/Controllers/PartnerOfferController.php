<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PartnerOfferController extends Controller
{
    public function index()
    {
        $offers = Service::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('partner.offers.index', compact('offers'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('partner.offers.create', compact('tags', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'categories_id' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $service = new Service();
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->slug = Str::slug($request->input('title'));
        $service->categories_id = $request->input('categories_id');
        $service->user_id = Auth::id();
        $service->status = 'pending_approval';
        $service->save();

        if ($request->has('tags')) {
            $service->tags()->attach($request->input('tags'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $image = new Image();
                $image->path = $imagePath;
                $image->service_id = $service->id;
                $image->save();
            }
        }

        return redirect()->route('partner.offers.index')
            ->with('success', 'Offre créée. Elle est en attente d\'approbation.');
    }

    public function edit(Service $offer)
    {
        if ($offer->user_id !== Auth::id()) {
            return redirect()->route('partner.offers.index')->with('error', 'Accès non autorisé.');
        }

        $tags = Tag::all();
        $categories = Category::all();
        return view('partner.offers.edit', compact('offer', 'tags', 'categories'));
    }

    public function update(Request $request, Service $offer)
    {
        if ($offer->user_id !== Auth::id()) {
            return redirect()->route('partner.offers.index')->with('error', 'Accès non autorisé.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'categories_id' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $offer->title = $request->input('title');
        $offer->description = $request->input('description');
        $offer->slug = Str::slug($request->input('title'));
        $offer->categories_id = $request->input('categories_id');
        $offer->status = 'pending_approval';
        $offer->approved_at = null;
        $offer->approved_by = null;
        $offer->save();

        $offer->tags()->sync($request->input('tags', []));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $image = new Image();
                $image->path = $imagePath;
                $image->service_id = $offer->id;
                $image->save();
            }
        }

        return redirect()->route('partner.offers.index')
            ->with('success', 'Offre mise à jour. Elle est repassée en attente d\'approbation.');
    }

    public function destroy(Service $offer)
    {
        if ($offer->user_id !== Auth::id()) {
            return redirect()->route('partner.offers.index')->with('error', 'Accès non autorisé.');
        }

        $offer->delete();

        return redirect()->route('partner.offers.index')
            ->with('success', 'Offre supprimée avec succès.');
    }
}
