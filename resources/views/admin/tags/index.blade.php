@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Categories de produit')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-lg">
        <div class="card mb-4">
            <h5 class="card-header">Création d'un nouveau tag</h5>
            <div>
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf

                    <label for="nom">Nom :</label>
                    <input type="text" name="name" id="name">

                    <button type="submit">Ajouter</button>
                </form>
            </div>

        </div>
    </div>

    <div class="col-lg">
        <div class="card mb-4">
            <h5 class="card-header">Liste des tags</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <th scope="row">{{ $tag->id }}</th>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                        class="btn btn-sm btn-primary">Editer</a>
                                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce tag ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
