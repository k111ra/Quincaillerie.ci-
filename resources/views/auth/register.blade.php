@extends('layouts.layout')

@section('content')
    <!-- page-title -->
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="page-title-heading">
                            <h1 class="title">Register</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span class="mr-1"><i class="ti ti-home"></i></span>
                            <a title="Homepage" href="index.html">Home</a>
                            <span class="ttm-bread-sep">&nbsp;/&nbsp;</span>
                            <span class="ttm-textcolor-skincolor">Register</span>
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
                    <div class="col-lg-4 ml-auto mr-auto">
                        <div class="wrap-login">
                            <form action="{{ route('register') }}" method="POST" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <i class="fa fa-user"></i>
                                    <input type="text" name='name' placeholder="Nom d'utilisateur" />
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-envelope-o"></i>
                                    <input type="email" name='email' placeholder="Email" />
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name='password' placeholder="Mot de passe" />
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-lock"></i>
                                    <input type="password" name='password_confirmation'
                                        placeholder="Confirmez le mot de passe" />
                                </div>
                                <div class="form-group">
                                    <i class="fa fa-phone"></i>
                                    <input name="your-phone" type="text" value="" placeholder="Téléphone" />
                                </div>
                                <div class="form-group">
                                    <button id="login-button" class="button action-button expand-center mb-15">
                                        <span class="label">Connexion</span>
                                        <span class="spinner"></span>
                                    </button>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}> <span class="ttm-textcolor-darkgrey">Se
                                            souvenir de moi</span>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="d-flex flex-row align-items-center">
                                            <a href="{{ route('password.request') }}" id="forgot-password-link"
                                                class="forgot-password-link">Mot de passe <u>oublié</u></a>
                                        </div>
                                    @endif

                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--login-section end-->


    </div><!--site-main end-->
@endsection
