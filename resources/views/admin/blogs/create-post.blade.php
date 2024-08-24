<!-- create-post.blade.php -->

@php
$container = 'container-fluid';
$containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Blogs')

@section('content')
    <h2>Create a New Post</h2>

    <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>

        <button type="submit">Create Post</button>
    </form>
@endsection
