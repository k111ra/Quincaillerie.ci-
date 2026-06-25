@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', "Modifier la section d'accueil")

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Modifier : {{ $section->title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.home-sections.update', $section) }}" method="POST">
                        @method('PUT')
                        @include('admin.home_sections._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
