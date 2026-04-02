@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Gestion des Carousels')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="bx bx-carousel me-2"></i>Gestion des Carousels
                    </h4>
                    <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i>Ajouter un Carousel
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($carousels->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="bx bx-image me-1"></i>Image</th>
                                        <th><i class="bx bx-text me-1"></i>Titre</th>
                                        <th><i class="bx bx-detail me-1"></i>Description</th>
                                        <th><i class="bx bx-link me-1"></i>Lien</th>
                                        <th><i class="bx bx-calendar me-1"></i>Créé le</th>
                                        <th class="text-center"><i class="bx bx-cog me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carousels as $carousel)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $carousel->image) }}"
                                                    alt="{{ $carousel->title }}" class="rounded"
                                                    style="width: 80px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <strong>{{ $carousel->title }}</strong>
                                            </td>
                                            <td>
                                                @if ($carousel->description)
                                                    <span title="{{ $carousel->description }}">
                                                        {{ Str::limit($carousel->description, 50) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($carousel->link)
                                                    <a href="{{ $carousel->link }}" target="_blank"
                                                        rel="noopener noreferrer" class="btn btn-sm btn-outline-primary"
                                                        title="Ouvrir le lien">
                                                        <i class="bx bx-link-external"></i> Lien
                                                    </a>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $carousel->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.carousel.edit', $carousel->id) }}"
                                                        class="btn btn-sm btn-warning" title="Modifier">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete({{ $carousel->id }}, '{{ $carousel->title }}')"
                                                        title="Supprimer">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination si nécessaire -->
                        @if ($carousels->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $carousels->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-carousel display-1 text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun carousel trouvé</h5>
                            <p class="text-muted">Commencez par créer votre premier carousel.</p>
                            <a href="{{ route('admin.carousel.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>Créer le premier carousel
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="bx bx-trash me-2"></i>Confirmer la suppression
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer le carousel "<strong id="carouselTitle"></strong>" ?</p>
                    <p class="text-danger mb-0">
                        <i class="bx bx-error-circle me-1"></i>Cette action est irréversible.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Annuler
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bx bx-trash me-1"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(carouselId, carouselTitle) {
            document.getElementById('carouselTitle').textContent = carouselTitle;
            document.getElementById('deleteForm').action = '{{ url('/admin/carousel') }}/' + carouselId;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
@endsection
