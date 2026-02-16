<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devenir Partenaire - Quincaillerie.ci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .partner-container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border: none;
        }

        .card-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .card-header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .card-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            font-size: 14px;
            color: #999;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }

        .text-danger {
            font-size: 13px;
            margin-top: 5px;
        }

        .header-link {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .header-link a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #667eea;
            font-weight: 600;
        }

        .header-link a img {
            height: 50px;
            margin-right: 10px;
        }

        .benefits {
            background: #f8f9ff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 13px;
            color: #555;
        }

        .benefits h6 {
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
        }

        .benefits ul {
            margin: 0;
            padding-left: 20px;
        }

        .benefits li {
            margin-bottom: 5px;
        }

        .info-badge {
            display: inline-block;
            background: #e7f3ff;
            color: #0066cc;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="partner-container">
        <div class="card">
            <div class="card-header">
                <h2>Devenir Partenaire</h2>
                <p>Rejoignez notre réseau de fournisseurs et développez votre activité</p>
            </div>

            <div class="card-body">
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

                <div class="benefits">
                    <h6><i class="fas fa-star"></i> Avantages partenaires:</h6>
                    <ul>
                        <li>Accès à des milliers de clients</li>
                        <li>Gestion facile de vos offres</li>
                        <li>Notifications en temps réel</li>
                        <li>Suivi des demandes en direct</li>
                    </ul>
                </div>

                <form action="{{ route('partner.register.store') }}" method="POST">
                    @csrf

                    <!-- Informations personnelles -->
                    <h5 class="mb-3" style="font-size: 16px; font-weight: 600; color: #333;">Informations personnelles
                    </h5>

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
                            <div class="info-badge">Min. 8 caractères</div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirmer mot de passe *</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Informations entreprise -->
                    <h5 class="mb-3 mt-4" style="font-size: 16px; font-weight: 600; color: #333;">Informations
                        entreprise</h5>

                    <div class="form-group form-row full">
                        <label for="company_name" class="form-label">Nom entreprise/magasin *</label>
                        <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                            id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                        @error('company_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
                            <input type="tel" class="form-control @error('whatsapp_number') is-invalid @enderror"
                                id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number') }}">
                            <div class="info-badge">Optionnel - pour les notifications</div>
                            @error('whatsapp_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-row full">
                        <label for="website" class="form-label">Site web</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
                            name="website" value="{{ old('website') }}" placeholder="https://example.com">
                        @error('website')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-row full">
                        <label for="description" class="form-label">Description activité</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3" placeholder="Décrivez votre activité et vos services...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-register mt-3">
                        <i class="fas fa-check-circle"></i> Créer mon compte partenaire
                    </button>
                </form>

                <div class="login-link">
                    Vous avez déjà un compte? <a href="{{ route('login') }}">Se connecter</a>
                </div>

                <div class="divider">
                    Ou retournez à <a href="{{ route('index') }}" style="color: #667eea;">l'accueil</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>

</html>
