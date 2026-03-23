@extends('layouts.layout')

@section('title', 'Devenir Partenaire')

@section('content')
    <style>
        .partner-registration {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .registration-container {
            width: 100%;
            max-width: 700px;
        }

        .registration-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: white;
        }

        .registration-header {
            background: linear-gradient(135deg, #f7a100 0%, #ff8823 100%);
            color: white;
            padding: 50px 40px;
            text-align: center;
            border: none;
        }

        .registration-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 32px;
            margin-bottom: 15px;
        }

        .registration-header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.95;
        }

        .registration-body {
            padding: 50px 40px;
        }

        .benefits-section {
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f2ff 100%);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 35px;
            border-left: 4px solid #f7a100;
        }

        .benefits-section h6 {
            margin-bottom: 15px;
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }

        .benefits-section ul {
            margin: 0;
            padding-left: 20px;
        }

        .benefits-section li {
            margin-bottom: 8px;
            color: #555;
        }

        .form-section {
            margin-bottom: 40px;
        }

        .form-section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f7a100;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
            display: block;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control:focus {
            border-color: #f7a100;
            box-shadow: 0 0 0 0.2rem rgba(247, 161, 0, 0.15);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .info-badge {
            display: inline-block;
            background: linear-gradient(135deg, #e7f3ff 0%, #d1e7ff 100%);
            color: #0066cc;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            margin-top: 8px;
            font-weight: 500;
        }

        .text-danger {
            font-size: 13px;
            margin-top: 6px;
            color: #dc3545;
        }

        .btn-register {
            background: linear-gradient(135deg, #f7a100 0%, #ff8823 100%);
            border: none;
            color: white;
            padding: 16px 24px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(247, 161, 0, 0.4);
            color: white;
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 25px;
            padding: 15px 20px;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee, #fdd);
            color: #c53030;
            border-left: 4px solid #e53e3e;
        }

        .navigation-links {
            text-align: center;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #e0e0e0;
        }

        .login-link {
            margin-bottom: 15px;
            font-size: 15px;
        }

        .login-link a {
            color: #f7a100;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .divider {
            font-size: 14px;
            color: #999;
            margin: 15px 0;
        }

        .divider a {
            color: #f7a100;
            text-decoration: none;
            font-weight: 600;
        }

        .divider a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .registration-header {
                padding: 30px 20px;
            }

            .registration-header h2 {
                font-size: 24px;
            }

            .registration-body {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .partner-registration {
                padding: 20px 15px;
            }
        }
    </style>

    <div class="partner-registration">
        <div class="registration-container">
            <div class="registration-card">
                <div class="registration-header">
                    <h2>Devenir Partenaire</h2>
                    <p>Rejoignez notre réseau de fournisseurs et développez votre activité</p>
                </div>

                <div class="registration-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Erreur!</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="benefits-section">
                        <h6><i class="fas fa-star"></i> Avantages partenaires:</h6>
                        <ul>
                            <li>Accès à des milliers de clients actifs</li>
                            <li>Gestion facile de vos offres et produits</li>
                            <li>Notifications en temps réel des commandes</li>
                            <li>Suivi des demandes et livraison simplifiée</li>
                            <li>Support technique et formation inclus</li>
                        </ul>
                    </div>

                    <form action="{{ route('partner.register.store') }}" method="POST">
                        @csrf

                        <!-- Informations personnelles -->
                        <div class="form-section">
                            <h5 class="form-section-title">Informations personnelles</h5>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nom complet *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password" class="form-label">Mot de passe *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required>
                                    <div class="info-badge">Minimum 8 caractères</div>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Confirmer mot de passe *</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informations entreprise -->
                        <div class="form-section">
                            <h5 class="form-section-title">Informations entreprise</h5>

                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="company_name" class="form-label">Nom entreprise/magasin *</label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                        id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                                    @error('company_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="telephone" class="form-label">Téléphone *</label>
                                    <input type="tel" class="form-control @error('telephone') is-invalid @enderror"
                                        id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                                    @error('telephone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="whatsapp_number" class="form-label">WhatsApp</label>
                                    <input type="tel"
                                        class="form-control @error('whatsapp_number') is-invalid @enderror"
                                        id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}">
                                    <div class="info-badge">Optionnel - pour les notifications</div>
                                    @error('whatsapp_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="website" class="form-label">Site web</label>
                                    <input type="text" class="form-control @error('website') is-invalid @enderror"
                                        id="website" name="website" value="{{ old('website') }}"
                                        placeholder="https://example.com">
                                    @error('website')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row full">
                                <div class="form-group">
                                    <label for="description" class="form-label">Description activité</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="4" placeholder="Décrivez votre activité, vos produits et services...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn-register">
                            <i class="fas fa-check-circle"></i> Créer mon compte partenaire
                        </button>
                    </form>

                    <div class="navigation-links">
                        <div class="login-link">
                            Vous avez déjà un compte? <a href="{{ route('login') }}">Se connecter</a>
                        </div>

                        <div class="divider">
                            Ou <a href="{{ route('index') }}">retourner à l'accueil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
