@extends('layouts.layout')

@section('title', 'Devenir Partenaire')

@section('content')
    <style>
        .partner-content {
            background: #f4f4f9;
            color: #2a2a2a;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .partner-hero {
            background: linear-gradient(135deg, #f7a100 0%, #ff8823 45%, #ffbd00 100%);
            padding: 70px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .partner-hero p {
            color: black;
        }

        .partner-hero h1 {
            font-size: 2.2rem;
            font-weight: 800;
        }

        .partner-hero p {
            font-size: 1.1rem;
            margin: 15px auto 0;
            max-width: 850px;
        }

        .partner-hero .btn-cta {
            margin-top: 24px;
            background: #1a73e8;
            border: none;
            color: white;
            padding: 12px 22px;
            font-size: 1rem;
            border-radius: 8px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, .2);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .partner-hero .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .28);
        }

        .info-cards {
            margin-top: -30px;
            text-align: center;
        }

        .info-cards .card {
            border: 0;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
            margin-bottom: 20px;
            min-height: 180px;
        }

        .info-cards .card-body {
            padding: 24px;
        }

        .info-cards .icon-circle {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #ffbd00;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: #fff;
            font-size: 1.4rem;
        }

        .section {
            padding: 60px 15px;
        }

        .section.bg-white {
            background: #fff;
        }

        .section h3 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section p {
            color: #545454;
        }

        .section ul {
            list-style: none;
            padding-left: 0;
        }

        .section ul li {
            margin-bottom: 8px;
            padding-left: 24px;
            position: relative;
        }

        .section ul li:before {
            content: "\2713";
            position: absolute;
            left: 0;
            color: #1a73e8;
            font-weight: bold;
        }

        .info-cards .card-illustration {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 3.5rem;
            overflow: hidden;
        }

        .info-cards .card-illustration img,
        .requirement-illustration img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
        }

        .requirement-section {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-bottom: 40px;
            padding: 20px;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .requirement-section .requirement-details {
            flex: 1;
            min-width: 220px;
            text-align: left;
        }

        .requirement-section h5 {
            font-size: 1.25rem;
            margin-bottom: 8px;
            color: #232323;
        }

        .requirement-section p {
            margin-bottom: 0;
            color: #4f4f4f;
        }

        .requirement-illustration {
            flex-shrink: 0;
            width: 160px;
            height: 160px;
            background: linear-gradient(135deg, #f7a100 0%, #ff8823 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .requirement-section {
                flex-direction: column;
                text-align: center;
            }

            .requirement-illustration {
                width: 100px;
                height: 100px;
            }
        }

        .process-step {
            text-align: center;
            padding: 20px;
            position: relative;
        }

        .process-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: linear-gradient(135deg, #f7a100 0%, #ff8823 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
        }

        .process-connector {
            position: absolute;
            top: 40px;
            right: -20px;
            width: 40px;
            height: 3px;
            background: #f7a100;
        }

        .process-step:last-child .process-connector {
            display: none;
        }
    </style>

    <div class="partner-hero">
        <h1>Vos clients sont ici, pourquoi pas vous ?</h1>
        <p>Rejoignez Quincaillerie.ci pour vendre en ligne, augmenter votre visibilité, et obtenir un support complet
            pour la logistique, le paiement et le service client.</p>
        <a href="{{ route('partner.register') }}" class="btn btn-cta">Commencer à vendre</a>
    </div>

    <div class="container section bg-white">
        <div class="">
            <h3>Commencez à vendre dès aujourd'hui</h3>
        </div> <br>

        <div class="row info-cards">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-illustration">
                            <img src="{{ asset('front/assets/images/partner/icons8-sac-de-courses.gif') }}" alt="">
                        </div>
                        <h5 class="card-title">Atteignez Vos clients</h5>
                        <p>Présentez vos produits à un public de clients actifs et multipliez vos opportunités de vente.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-illustration">
                            <img src="{{ asset('front/assets/images/partner/icons8-en-espèces.gif') }}" alt="">
                        </div>
                        <h5 class="card-title">Plus de 500 000 F CFA par mois</h5>
                        <p>40% de nos vendeurs gagnent plus de 500 000 F CFA par mois via la plateforme.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-illustration">
                            <img src="{{ asset('front/assets/images/partner/icons8-liste-de-choses-à-faire.gif') }}"
                                alt="">
                        </div>
                        <h5 class="card-title">On fait le gros du travail</h5>
                        <p>Prise en charge de la visibilité, paiement sécurisé, livraison et service client.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container section">
        <h3>De quoi avez-vous besoin pour être un vendeur ?</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="requirement-section">
                    <div class="requirement-illustration">
                        <img src="{{ asset('front/assets/images/partner/emplacement.png') }}" alt="">
                    </div>
                    <div class="requirement-details">
                        <h5>Emplacement</h5>
                        <p>Être basé à Abidjan pour la livraison locale. Nous travaillons avec les fournisseurs ayant des
                            opérations locales.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="requirement-section">
                    <div class="requirement-illustration">
                        <img src="{{ asset('front/assets/images/partner/authentic.png') }}" alt="">
                    </div>
                    <div class="requirement-details">
                        <h5>Produits authentiques</h5>
                        <p>Vendre des produits neufs et authentiques. Nous n'acceptons pas les articles usagés ou
                            contrefaits.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container section bg-white">
        <h3>Comment ça fonctionne ?</h3>
        <div class="row text-center">
            <div class="col-md-2">
                <div class="process-step">
                    <div class="process-icon">
                        <svg width="50" height="50" viewBox="0 0 100 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M30 50L50 30L70 50V80H30V50Z" fill="white" opacity="0.3" />
                            <path d="M30 50L50 30L70 50V80H30V50Z" stroke="white" stroke-width="2" fill="none" />
                            <circle cx="50" cy="60" r="8" fill="white" />
                        </svg>
                    </div>
                    D'où vient le stock<br><strong style="color: #f7a100;">Le vendeur</strong>
                    <div class="process-connector"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="process-step">
                    <div class="process-icon">
                        <svg width="50" height="50" viewBox="0 0 100 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="25" y="20" width="50" height="60" rx="2" fill="white"
                                opacity="0.3" />
                            <rect x="25" y="20" width="50" height="60" rx="2" stroke="white" stroke-width="2"
                                fill="none" />
                            <path d="M35 40H65M35 60H65M35 80H65" stroke="white" stroke-width="1.5" />
                        </svg>
                    </div>
                    Emballage<br><strong style="color: #f7a100;">Le vendeur</strong>
                    <div class="process-connector"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="process-step">
                    <div class="process-icon">
                        <svg width="50" height="50" viewBox="0 0 100 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M50 30L75 50V80H25V50L50 30Z" fill="white" opacity="0.3" />
                            <path d="M50 30L75 50V80H25V50L50 30Z" stroke="white" stroke-width="2" fill="none" />
                            <circle cx="50" cy="60" r="6" fill="white" />
                            <path d="M50 55V65" stroke="white" stroke-width="1.5" />
                        </svg>
                    </div>
                    Livraison<br><strong style="color: #f7a100;">Quincaillerie</strong>
                    <div class="process-connector"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="process-step">
                    <div class="process-icon">
                        <svg width="50" height="50" viewBox="0 0 100 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="30" fill="white" opacity="0.3" />
                            <circle cx="50" cy="50" r="30" stroke="white" stroke-width="2"
                                fill="none" />
                            <path d="M40 45L48 55L60 40" stroke="white" stroke-width="2.5" fill="none"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    Après vente<br><strong style="color: #f7a100;">Quincaillerie</strong>
                    <div class="process-connector"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="process-step">
                    <div class="process-icon">
                        <svg width="50" height="50" viewBox="0 0 100 100" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M25 40C25 30 35 25 50 25C65 25 75 30 75 40V75H25V40Z" fill="white"
                                opacity="0.3" />
                            <path d="M25 40C25 30 35 25 50 25C65 25 75 30 75 40V75H25V40Z" stroke="white" stroke-width="2"
                                fill="none" />
                            <circle cx="40" cy="55" r="5" fill="white" />
                            <circle cx="60" cy="55" r="5" fill="white" />
                            <path d="M40 65C45 70 55 70 60 65" stroke="white" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    Service client<br><strong style="color: #f7a100;">Quincaillerie</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center section">
        <a href="{{ route('partner.register') }}" class="btn btn-lg btn-primary">Je veux devenir partenaire</a>
    </div>
@endsection
