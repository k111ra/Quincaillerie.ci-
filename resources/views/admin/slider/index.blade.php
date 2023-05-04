@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Categories de produit')

@section('content')

@if(session('success'))
<div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <i class='bx bx-bell me-2'></i>
    <div class="me-auto fw-semibold">Slide</div>
    {{-- <small>11 mins ago</small> --}}
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    {{ session('success') }}
  </div>
</div>
@endif

<div class="container">
  <h1>Create New Carousel Item</h1>
  <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
      </div>
      <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input class="form-control" type="file" id="image" name="image">
      </div>
      {{-- <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control-file" id="image" name="image">
      </div> --}}
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<div class="container">
  <h1>Carousels</h1>
  {{-- <a href="{{ route('carousels.create') }}" class="btn btn-primary mb-2">Add Carousel</a> --}}
  <table class="table">
      <thead>
          <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Image</th>
              <th scope="col">Action</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($carousels as $carousel)
              <tr>
                  <th scope="row">{{ $carousel->id }}</th>
                  <td>{{ $carousel->title }}</td>
                  <td><img src="{{ asset('storage/' . $carousel->image) }}" width="100" alt="{{ $carousel->title }}"></td>
                  <td>
                      <a href="{{ route('admin.slider.edit', $carousel->id) }}" class="btn btn-sm btn-primary">Edit</a>
                      <form action="{{ route('admin.slider.destroy', $carousel->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('POST')
                          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
</div>

@endsection
