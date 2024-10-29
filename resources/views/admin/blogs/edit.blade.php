@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Post')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Post</h2>
                </div>
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT method for updating -->

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" required
                                value="{{ old('title', $post->title) }}">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Details -->
                        <div class="mb-3">
                            <label for="details" class="form-label">Details:</label>
                            <textarea id="details" name="details" class="form-control" rows="3">{{ old('details', $post->details) }}</textarea>
                            @error('details')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Content:</label>
                            <textarea name="description" id="description" class="form-control" required>{{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Images:</label>

                            <!-- Display existing images if any -->
                            @if ($post->image && json_decode($post->image))
                                <div class="mb-3">
                                    @foreach (json_decode($post->image) as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="Image" class="img-thumbnail"
                                            width="100">
                                    @endforeach
                                </div>
                            @endif

                            <!-- File input for new images -->
                            <input type="file" class="form-control" name="image[]" id="image" multiple>
                            @error('image.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags:</label>
                            <select name="tags[]" id="tags" class="form-control" multiple>
                                {{-- @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                            @error('tags')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
