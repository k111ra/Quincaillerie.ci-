@extends('layouts.contentNavbarLayout')

@section('title', 'Recherches effectuées')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Historique des recherches</h3>
                    </div>
                    <div class="card-body">
                        @if ($searchLogs->isEmpty())
                            <div class="alert alert-info text-center mb-0">
                                Aucune recherche enregistrée pour le moment.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="thead-light">
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
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $searchLogs->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
