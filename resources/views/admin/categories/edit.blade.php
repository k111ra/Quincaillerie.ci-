<!-- resources/views/categories/edit.blade.php -->
@extends('layouts/contentNavbarLayout')

@section('title', 'Modifier la catégorie')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Modifier la catégorie</div>

                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" required>{{ $category->description }}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="parent">Categorie Supperieur</label>
                          <select name="parent_id" id="parent" class="form-control">
                            <option value="{{ $category->parent->id }}">{{ $category->parent->name }}</option>
                            @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                          </select>
                      </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
