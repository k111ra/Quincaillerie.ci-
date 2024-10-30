@extends('layouts/contentNavbarLayout')

@section('title', 'Liste des Posts')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Liste des Posts</h2>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary float-end mb-3">Créer un Nouveau Post</a>
        </div>

        <!-- Search Form -->
        <div class="col-md-12 mb-3">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un post"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-secondary">Rechercher</button>
            </form>
        </div>
    </div>

    <!-- Grille des posts -->
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        @foreach ($posts as $post)
            <div class="col">
                <div class="card h-100">
                    @if ($post->image && json_decode($post->image))
                        <img class="card-img-top" src="{{ asset('storage/' . json_decode($post->image)[0]) }}"
                            alt="Image du post">
                    @else
                        <img class="card-img-top" src="https://via.placeholder.com/150" alt="Image non disponible">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! \Illuminate\Support\Str::limit($post->description, 100) !!}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info btn-sm">Voir plus</a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Voulez-vous vraiment supprimer ce post ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $posts->appends(['search' => request('search')])->links() }}
    </div>
@endsection
