@extends('layouts.app')
@section('css')
    <style>
        .form-elegant .font-small {
        font-size: 0.8rem; }

        .form-elegant .z-depth-1a {
        -webkit-box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25);
        box-shadow: 0 2px 5px 0 rgba(55, 161, 255, 0.26), 0 4px 12px 0 rgba(121, 155, 254, 0.25); }

        .form-elegant .z-depth-1-half,
        .form-elegant .btn:hover {
        -webkit-box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15);
        box-shadow: 0 5px 11px 0 rgba(85, 182, 255, 0.28), 0 4px 15px 0 rgba(36, 133, 255, 0.15); }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center py-4">

        <section class="form-elegant">

            <!--Form without header-->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="card">

                    <div class="card-body mx-4">

                        <!--Header-->
                        <div class="text-center">
                            <h3 class="dark-grey-text mb-5"><strong>Registro en {{ setting('site.title') }}</strong></h3>
                        </div>

                        <!--Body-->
                    
                        <div class="md-form">
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            <label for="name">Name Complet</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="md-form">
                            <input type="text" id="email" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('name') }}" required>
                            <label for="email">Your email</label>
                        </div>

                        <div class="md-form pb-3">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <label for="password">Your password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                            <div class="md-form">
                                @captcha
                                <input type="text" class="form-control @error('captcha') is-invalid @enderror" id="captcha" name="captcha" autocomplete="off" placeholder="Ingresa el codigo de la imagen">
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn blue-gradient btn-block btn-rounded z-depth-1a">Enviar</button>
                            <a href="/" class="btn green-gradient btn-block btn-rounded z-depth-1a">VOlver al Home</a>
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer mx-5 pt-3 mb-1">
                    <p class="font-small grey-text d-flex justify-content-end">Ya tienes cuenta ? <a href="/login"
                        class="blue-text ml-1"> Ingresar</a></p>
                    </div>
                </div>
            </form>
            <!--/Form without header-->

        </section>
    </div>
</div>
@endsection
