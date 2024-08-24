@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'caroussel')

@section('content')
    <h1>Modifier Carousel</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" value="{{ $carousel->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $carousel->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-success">Modifier</button>
    </form>
@endsection
