<!-- create-post.blade.php -->

@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Blogs')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">Create a New Post</div>

    <div class="card-body">
      <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" required>
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" class="form-control" id="content" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
<br>
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
    </div>

  </div>

</div>

@endsection
