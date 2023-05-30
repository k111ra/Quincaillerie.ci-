@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Categories de produit')

@section('content')

    @if (session('success'))
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
        <form action="{{ route('admin.slider.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                    value="{{ old('title', $carousel->title) }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $carousel->description) }}</textarea>
            </div>
            <br>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if ($carousel->image)
                    <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}"
                        width="100">
                @endif
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>



@endsection
