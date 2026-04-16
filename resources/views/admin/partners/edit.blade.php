@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold"><span class="text-muted fw-light">Admin / Partenaires /</span> Modifier</h4>
                <p class="text-muted mb-0">Mettez à jour les informations du partenaire sélectionné.</p>
            </div>
            <a href="{{ route('admin.partners.show', $partner) }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Retour
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom du responsable</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $partner->user->name ?? '') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom de l'entreprise</label>
                            <input type="text" name="company_name" class="form-control"
                                value="{{ old('company_name', $partner->nom) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email principal</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $partner->email_primary ?? ($partner->user->email ?? '')) }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone du compte</label>
                            <input type="text" name="tel" class="form-control"
                                value="{{ old('tel', $partner->user->tel ?? $partner->phone_primary) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone principal</label>
                            <input type="text" name="phone_primary" class="form-control"
                                value="{{ old('phone_primary', $partner->phone_primary) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone secondaire</label>
                            <input type="text" name="phone_secondary" class="form-control"
                                value="{{ old('phone_secondary', $partner->phone_secondary) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email secondaire</label>
                            <input type="email" name="email_secondary" class="form-control"
                                value="{{ old('email_secondary', $partner->email_secondary) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" name="whatsapp_number" class="form-control"
                                value="{{ old('whatsapp_number', $partner->whatsapp_number) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control"
                            value="{{ old('adresse', $partner->adresse) }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Site web</label>
                            <input type="text" name="website" class="form-control"
                                value="{{ old('website', $partner->website) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Statut</label>
                            <select name="status" class="form-select" required>
                                @foreach (['pending_approval' => 'En attente', 'approved' => 'Approuvé', 'rejected' => 'Rejeté', 'active' => 'Actif'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('status', $partner->status) === $value)>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="5" class="form-control">{{ old('description', $partner->description) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i> Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.partners.show', $partner) }}"
                            class="btn btn-outline-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
