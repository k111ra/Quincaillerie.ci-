@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Mes Offres</h4>
        <a href="{{ route('partner.offers.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Nouvelle offre
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($offers as $offer)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>
                                @if($offer->status === 'approved')
                                    <span class="badge bg-success">Approuvé</span>
                                @elseif($offer->status === 'pending_approval')
                                    <span class="badge bg-warning">En attente</span>
                                @else
                                    <span class="badge bg-danger">Rejeté</span>
                                @endif
                            </td>
                            <td>{{ $offer->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('partner.offers.edit', $offer) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('partner.offers.destroy', $offer) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette offre ?')">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucune offre</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $offers->links() }}
        </div>
    </div>
</div>
@endsection
