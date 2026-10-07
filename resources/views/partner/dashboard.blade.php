@extends('layouts.layout')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#profil" class="list-group-item list-group-item-action active" data-toggle="tab">
                        <i class="fa fa-user"></i> Mon Profil
                    </a>
                    <a href="#offres" class="list-group-item list-group-item-action" data-toggle="tab">
                        <i class="fa fa-gift"></i> Mes Offres
                    </a>
                    <a href="#produits" class="list-group-item list-group-item-action" data-toggle="tab">
                        <i class="fa fa-box"></i> Mes Produits
                    </a>
                    <a href="#partnerSponsoringMenu" class="list-group-item list-group-item-action"
                        data-toggle="collapse" aria-expanded="false" aria-controls="partnerSponsoringMenu">
                        <i class="fa fa-star"></i> Sponsoring <i class="fa fa-angle-down float-right"></i>
                    </a>
                    <div class="collapse" id="partnerSponsoringMenu">
                        <a href="{{ route('partner.sponsoring.index') }}"
                            class="list-group-item list-group-item-action pl-5">
                            <i class="fa fa-bullhorn"></i> Offres de sponsoring
                        </a>
                    </div>
                    <a href="#demandes" class="list-group-item list-group-item-action" data-toggle="tab">
                        <i class="fa fa-envelope"></i> Demandes Reçues
                    </a>
                    <a href="#phases" class="list-group-item list-group-item-action" data-toggle="tab">
                        <i class="fa fa-rocket"></i> Phases à Venir
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fa fa-sign-out"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-3">
                        <i class="fa fa-times-circle"></i> {{ session('error') }}
                    </div>
                @endif

                <!-- Status Alert -->
                <div class="alert alert-info mb-3">
                    <strong>Status Partenaire:</strong>
                    @if ($fournisseur->status === 'approved')
                        <span class="badge badge-success">
                            <i class="fa fa-check-circle"></i> Approuvé
                        </span>
                    @elseif($fournisseur->status === 'pending_approval')
                        <span class="badge badge-warning">
                            <i class="fa fa-hourglass-half"></i> En attente d'approbation
                        </span>
                    @elseif($fournisseur->status === 'rejected')
                        <span class="badge badge-danger">
                            <i class="fa fa-times-circle"></i> Rejeté
                        </span>
                    @endif
                </div>

                <div class="tab-content">
                    <!-- Tab 1: Profil -->
                    <div class="tab-pane fade show active" id="profil">
                        <h4 class="mb-3">Mon Profil Partenaire</h4>

                        @if ($fournisseur->status === 'pending_approval')
                            <div class="alert alert-warning">
                                <i class="fa fa-info-circle"></i> Votre profil est en attente d'approbation.
                                Nous vous contacterons par email dès que possible.
                            </div>
                        @elseif($fournisseur->status === 'approved')
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i> Votre profil est approuvé.
                                Vous pouvez maintenant créer des offres et recevoir des demandes.
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6><strong>Nom de l'Entreprise</strong></h6>
                                <p>{{ $fournisseur->nom }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Votre Nom</strong></h6>
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6><strong>Email Principal</strong></h6>
                                <p>{{ $fournisseur->email_primary ?? $user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Téléphone Principal</strong></h6>
                                <p>{{ $fournisseur->phone_primary ?? 'Non spécifié' }}</p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6><strong>WhatsApp</strong></h6>
                                <p>{{ $fournisseur->whatsapp_number ?? 'Non spécifié' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Site Web</strong></h6>
                                @if ($fournisseur->website)
                                    <p><a href="{{ $fournisseur->website }}" target="_blank">{{ $fournisseur->website }}</a>
                                    </p>
                                @else
                                    <p>Non spécifié</p>
                                @endif
                            </div>
                        </div>

                        @if ($fournisseur->description)
                            <div class="mb-4">
                                <h6><strong>Description</strong></h6>
                                <p>{{ $fournisseur->description }}</p>
                            </div>
                        @endif

                        @if ($fournisseur->approved_at)
                            <div class="mb-4">
                                <h6><strong>Date d'Approbation</strong></h6>
                                <p>{{ $fournisseur->approved_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        @endif

                        <hr>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-3"><i class="fa fa-edit"></i> Modifier mes informations</h5>
                                <p class="text-muted small">
                                    Toute modification de votre profil partenaire sera transmise à l'administrateur pour
                                    validation.
                                </p>

                                <form action="{{ route('partner.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>Votre nom</strong></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>Nom de l'entreprise</strong></label>
                                            <input type="text" name="company_name"
                                                class="form-control @error('company_name') is-invalid @enderror"
                                                value="{{ old('company_name', $fournisseur->nom) }}" required>
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>Email</strong></label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $fournisseur->email_primary ?? $user->email) }}"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>Téléphone principal</strong></label>
                                            <input type="text" name="telephone"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                value="{{ old('telephone', $fournisseur->phone_primary ?? $user->tel) }}"
                                                required>
                                            @error('telephone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>Téléphone secondaire</strong></label>
                                            <input type="text" name="phone_secondary"
                                                class="form-control @error('phone_secondary') is-invalid @enderror"
                                                value="{{ old('phone_secondary', $fournisseur->phone_secondary) }}">
                                            @error('phone_secondary')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>WhatsApp</strong></label>
                                            <input type="text" name="whatsapp_number"
                                                class="form-control @error('whatsapp_number') is-invalid @enderror"
                                                value="{{ old('whatsapp_number', $fournisseur->whatsapp_number) }}">
                                            @error('whatsapp_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><strong>Adresse</strong></label>
                                        <input type="text" name="adresse"
                                            class="form-control @error('adresse') is-invalid @enderror"
                                            value="{{ old('adresse', $fournisseur->adresse) }}">
                                        @error('adresse')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><strong>Site web</strong></label>
                                        <input type="text" name="website"
                                            class="form-control @error('website') is-invalid @enderror"
                                            value="{{ old('website', $fournisseur->website) }}">
                                        @error('website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><strong>Description</strong></label>
                                        <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $fournisseur->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Enregistrer mes modifications
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Mes Offres -->
                    <div class="tab-pane fade" id="offres">
                        <h4 class="mb-3">Mes Offres</h4>

                        @if ($fournisseur->status !== 'approved')
                            <div class="alert alert-warning">
                                <i class="fa fa-lock"></i> Vous devez être approuvé pour créer des offres.
                                Votre profil est actuellement en statut: <strong>{{ $fournisseur->status }}</strong>
                            </div>
                        @else
                            <!-- Statistiques des Offres -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">{{ $stats['total_offers'] }}</h5>
                                            <p class="card-text small">Total d'Offres</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title text-success">{{ $stats['approved_offers'] }}</h5>
                                            <p class="card-text small">Approuvées</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title text-warning">{{ $stats['pending_offers'] }}</h5>
                                            <p class="card-text small">En Attente</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title text-danger">{{ $stats['rejected_offers'] }}</h5>
                                            <p class="card-text small">Rejetées</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <a href="{{ route('partner.offers.create') }}" class="btn btn-success mb-3">
                                <i class="fa fa-plus"></i> Créer une Nouvelle Offre
                            </a>
                            <a href="{{ route('partner.offers.index') }}" class="btn btn-primary mb-3">
                                <i class="fa fa-list"></i> Gérer Mes Offres
                            </a>

                            <!-- Tableau des Offres -->
                            @if ($offers->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Titre</th>
                                                <th>Statut</th>
                                                <th>Date Création</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($offers->take(5) as $offer)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $offer->title }}</strong>
                                                    </td>
                                                    <td>
                                                        @if ($offer->status === 'approved')
                                                            <span class="badge badge-success">
                                                                <i class="fa fa-check-circle"></i> Approuvée
                                                            </span>
                                                        @elseif($offer->status === 'pending_approval')
                                                            <span class="badge badge-warning">
                                                                <i class="fa fa-hourglass-half"></i> En Attente
                                                            </span>
                                                        @elseif($offer->status === 'rejected')
                                                            <span class="badge badge-danger">
                                                                <i class="fa fa-times-circle"></i> Rejetée
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $offer->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('partner.offers.edit', $offer) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">
                                                        <i class="fa fa-inbox"></i> Aucune offre créée pour le moment
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($offers->count() > 5)
                                    <p class="text-center text-muted small">
                                        Affichage de 5 offres sur {{ $offers->count() }}.
                                        <a href="{{ route('partner.offers.index') }}">Voir toutes les offres →</a>
                                    </p>
                                @endif
                            @else
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> Vous n'avez pas encore créé d'offres.
                                    <a href="{{ route('partner.offers.create') }}" class="btn btn-sm btn-primary">Créer
                                        une offre</a>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Tab 3: Demandes Reçues -->
                    <div class="tab-pane fade" id="demandes">
                        <h4 class="mb-3">Demandes Reçues</h4>

                        @if ($fournisseur->status !== 'approved')
                            <div class="alert alert-warning">
                                <i class="fa fa-lock"></i> Vous devez être approuvé pour recevoir des demandes.
                            </div>
                        @else
                            <p class="text-muted">
                                <i class="fa fa-info-circle"></i> Les demandes seront disponibles en Phase 3.
                            </p>
                        @endif

                        <div class="alert alert-info mt-3">
                            <strong>Phase 3 (4-6 semaines):</strong> Vous recevrez les demandes des clients et pourrez
                            y répondre directement.
                        </div>
                    </div>

                    <!-- Tab 5: Mes Produits -->
                    <div class="tab-pane fade" id="produits">
                        <h4 class="mb-3">Mes Produits</h4>

                        @if ($fournisseur->status !== 'approved')
                            <div class="alert alert-warning">
                                <i class="fa fa-lock"></i> Vous devez être approuvé pour créer des produits.
                                Votre profil est actuellement en statut: <strong>{{ $fournisseur->status }}</strong>
                            </div>
                        @else
                            <!-- Statistiques des Produits -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">{{ $stats['total_products'] }}</h5>
                                            <p class="card-text small">Total de Produits</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">
                                <i class="fa fa-plus"></i> Ajouter un Produit
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-primary mb-3">
                                <i class="fa fa-list"></i> Gérer Mes Produits
                            </a>

                            <!-- Tableau des Produits -->
                            @if ($products->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nom</th>
                                                <th>Catégorie</th>
                                                <th>Prix</th>
                                                <th>Stock</th>
                                                <th>Date Création</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($products->take(5) as $product)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('product', $product->slug) }}" class="text-dark">
                                                            <strong>{{ $product->nom ?? $product->name }}</strong>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if ($product->category)
                                                            <span
                                                                class="badge badge-secondary">{{ $product->category->name }}</span>
                                                        @else
                                                            <span class="text-muted small">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($product->prix || $product->price)
                                                            {{ $product->prix ?? $product->price }} F CFA
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($product->quantity !== null)
                                                            <span
                                                                class="badge {{ $product->quantity > 0 ? 'badge-success' : 'badge-danger' }}">
                                                                {{ $product->quantity }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('products.edit', $product) }}"
                                                            class="btn btn-sm btn-info">
                                                            <i class="fa fa-edit"></i> Modifier
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        <i class="fa fa-inbox"></i> Aucun produit ajouté pour le moment
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if ($products->count() > 5)
                                    <p class="text-center text-muted small">
                                        Affichage de 5 produits sur {{ $products->count() }}.
                                        <a href="{{ route('products.index') }}">Voir tous les produits →</a>
                                    </p>
                                @endif
                            @else
                                <div class="alert alert-info">
                                    <i class="fa fa-info-circle"></i> Vous n'avez pas encore ajouté de produits.
                                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">Ajouter un
                                        produit</a>
                                </div>
                            @endif
                        @endif
                    </div>

                    <!-- Tab 4: Phases à Venir -->
                    <div class="tab-pane fade" id="phases">
                        <h4 class="mb-3">Roadmap - Phases à Venir</h4>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <span class="badge badge-primary">Phase 1</span>
                                    Inscription & Approbation
                                    <span class="badge badge-success float-right">Complétée</span>
                                </h6>
                                <p class="card-text">
                                    ✅ Créer un compte partenaire<br>
                                    ✅ Voir votre profil<br>
                                    ✅ En attente d'approbation admin
                                </p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <span class="badge badge-secondary">Phase 2</span>
                                    Gestion des Offres
                                    <span class="badge badge-warning float-right">2-3 semaines</span>
                                </h6>
                                <p class="card-text">
                                    📝 Créer et gérer vos offres<br>
                                    ✍️ Modifier les offres publiées<br>
                                    👀 Admin approuve les offres<br>
                                    🌐 Les clients voient vos offres
                                </p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <span class="badge badge-secondary">Phase 3</span>
                                    Gestion des Demandes
                                    <span class="badge badge-warning float-right">4-6 semaines</span>
                                </h6>
                                <p class="card-text">
                                    📧 Recevoir les demandes des clients<br>
                                    💬 Communiquer avec les clients<br>
                                    📋 Timeline des échanges<br>
                                    ✅ Finaliser les demandes
                                </p>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <span class="badge badge-secondary">Phase 4</span>
                                    Notifications Avancées
                                    <span class="badge badge-warning float-right">6-8 semaines</span>
                                </h6>
                                <p class="card-text">
                                    🔔 Notifications Email<br>
                                    📱 Notifications WhatsApp<br>
                                    📊 Logs & Analytics<br>
                                    📈 Tableau de bord analytique
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .list-group-item {
            border: 1px solid #ddd;
        }

        .list-group-item.active {
            background-color: #007bff;
            border-color: #007bff;
        }

        .badge {
            padding: 0.5rem 0.75rem;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 0.25rem;
        }

        .tab-pane {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 0.25rem;
            border: 1px solid #ddd;
        }

        h4 {
            color: #333;
            font-weight: bold;
        }

        h6 {
            color: #666;
            margin-top: 0.5rem;
        }
    </style>
@endsection
