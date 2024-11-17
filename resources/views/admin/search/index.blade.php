@extends('layouts/contentNavbarLayout')

@section('title', 'recherche effectue')

@section('content')

    <div class="container">
        <h1 class="my-4">Recherches effectuées</h1>

        @if ($searchLogs->isEmpty())
            <p>Aucune recherche enregistrée pour le moment.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Requête</th>
                        <th>Utilisateur</th>
                        <th>Adresse IP</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($searchLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->query }}</td>
                            <td>{{ $log->user_id ? $log->user->name : 'Invité' }}</td>
                            <td>{{ $log->ip_address }}</td>
                            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $searchLogs->links() }}
        @endif
    </div>

@endsection
