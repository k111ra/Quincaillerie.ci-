@extends('layouts.layout')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
 <!--page start-->
 <div class="page">

      <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Connexion</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.html">Accueil</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Connexion</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-title end-->

<!--site-main start-->
<div class="site-main">

    <!--login-section-->
    <section class="login-section bg-img2 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 ml-auto mr-auto">
                    <div class="wrap-login">
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <i class="fa fa-envelope-o"></i>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            </div>
                            <div class="form-group">
                                <i class="fa fa-lock"></i>
                                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                            </div>
                            {{-- <div class="pt-5">
                                <h6 class="font-weight-normal">OR</h6>
                            </div>
                            <div class="login-social-buttons">
                                <button id="login-with-facebook" data-network="Facebook" class="social-account-button facebook-button">
                                    <i class="ti ti-facebook">
                                    </i>
                                    <span>Facebook</span>
                                </button>
                                &nbsp;&nbsp;
                                <button id="login-with-google" data-network="google" class="social-account-button google-button">
                                    <i class="ti ti-google">
                                    </i>
                                    <span>Google</span>
                                </button>
                            </div> --}}
                            <div class="form-group">
                                <button id="login-button" type="submit" class="button action-button expand-center mb-15">
                                    <span class="label">Connexion</span>
                                    <span class="spinner"></span>
                                </button>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center justify-content-start">
                                    <input type="checkbox" {{ old('remember') ? 'checked' : '' }}> <span class="ttm-textcolor-darkgrey">Souviens-toi de moi</span>
                                </div>
                                <div class="d-flex flex-row align-items-center justify-content-end">
                                    <a href="{{ route('password.request') }}" id="forgot-password-link" class="forgot-password-link"><u>Mot de passe oublié?</u></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--login-section end-->

</div><!--site-main end-->

@endsection
