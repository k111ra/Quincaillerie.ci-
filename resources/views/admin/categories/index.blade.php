@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Categories de produit')

@section('content')
<!-- resources/views/categories/index.blade.php -->
@if(session('success'))
<div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-semibold">Categorie</div>
    {{-- <small>11 mins ago</small> --}}
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{ session('success') }}
  </div>
</div>
@endif

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Liste des catégories</div>

              <div class="card-body">
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Nom</th>
                              <th>Description</th>
                              <th>Catégorie parent</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($categories as $category)
                              <tr>
                                  <td>{{ $category->name }}</td>
                                  <td>{{ $category->description }}</td>
                                  <td>
                                      @if ($category->parent)
                                          {{ $category->parent->name }}
                                      @else
                                          Pas de parent
                                      @endif
                                  </td>
                                  <td>
                                      <a href="{{ route('admin.categories.edit', $category->id) }}">Editer</a>
                                      <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-link">Supprimer</button>
                                      </form>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>

                  <div class="mt-4">
                      <h4>Ajouter une catégorie</h4>

                      <form action="{{ route('admin.categories.store') }}" method="POST">
                          @csrf

                          <div class="form-group">
                              <label for="name">Nom</label>
                              <input type="text" class="form-control" name="name" id="name" required>
                          </div>

                          <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                          </div>

                          <div class="form-group">
                              <label for="parent_id">Catégorie parent</label>
                              <select class="form-control" name="parent_id" id="parent_id">
                                  <option value="">Pas de parent</option>
                                  @foreach ($parents as $id => $name)
                                      <option value="{{ $id }}">{{ $name }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <button type="submit" class="btn btn-primary">Ajouter</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


@endsection
