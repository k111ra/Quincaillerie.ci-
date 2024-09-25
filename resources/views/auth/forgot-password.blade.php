@extends('layouts.layout')

@section('content')

    <!--page start-->
    <div class="page">

        <!-- page-title -->
        <div class="ttm-page-title-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="page-title-heading">
                                <h1 class="title">Mot de passe oublié</h1>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <span class="mr-1"><i class="ti ti-home"></i></span>
                                <a title="Homepage" href="/">Accueil</a>
                                <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                                <span class="ttm-textcolor-skincolor">Mot de passe oublié</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- page-title end-->

        <!--site-main start-->
        <div class="site-main">

            <!--password-reset-section-->
            <section class="password-reset-section bg-img2 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 ml-auto mr-auto">
                            <div class="wrap-login">
                                <div class="mb-4 text-sm text-gray-600">
                                    {{ __('Mot de passe oublié ? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}
                                </div>

                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-4">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <!-- Validation Errors -->
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <i class="fa fa-envelope-o"></i>
                                        <input id="email" type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required autofocus placeholder="Votre e-mail">
                                    </div>

                                    <div class="form-group">
                                        <button id="reset-password-button" type="submit"
                                            class="button action-button expand-center mb-15">
                                            <span class="label">Envoyer le lien de réinitialisation</span>
                                            <span class="spinner"></span>
                                        </button>
                                    </div>

                                    <div class="form-group d-flex justify-content-center">
                                        <a href="{{ route('login') }}" id="back-to-login-link"
                                            class="forgot-password-link"><u>Retour à la connexion</u></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--password-reset-section end-->

        </div><!--site-main end-->

    @endsection
