@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'caroussel')

@section('content')
    <h1>Carousels</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary mb-3">Ajouter un Carousel</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carousels as $carousel)
                <tr>
                    <td>{{ $carousel->title }}</td>
                    <td>{{ $carousel->description }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $carousel->image) }}" alt="{{ $carousel->title }}" width="100">
                    </td>
                    <td>
                        <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                        <form action="{{ route('admin.carousel.destroy', $carousel->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
