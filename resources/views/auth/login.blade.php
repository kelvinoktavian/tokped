<?php 
$title = 'Login';
$active = 'login';
?>

@extends('layouts.app')

@section('content')

<x-alert />
<section id="login-page">
    <div class="container p-5">
        <div class="row justify-content-center">
                <div class="card m-0 p-0 bg-black">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col p-0">
                                <img src="{{ asset('images/img/welcome-image1.png') }}" alt="">
                            </div>
                            <div class="col p-5">
                                <h2>Login</h2>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group row py-1">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            
                                        <div class="col-md-7">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
            
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row py-1">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                                        <div class="col-md-7">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="current-password">
            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
            

                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        
            
                                        <div class="col offset-md-4 p-0">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    <small>Remember me</small>
                                                </label>
                                            </div>
                                        </div>
                                        

                                        <div class="col p-0">
                                            @if (Route::has('password.request'))
                                            <a id="forgot-pass" target="_blank" class="" href="{{ route('password.request') }}">
                                                <small>{{ __('Forgot Your Password?') }}</small>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-7 offset-md-4 p-0">
                                            <button type="submit" class="btn-dark-round-outline">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-7 offset-md-4 p-0">
                                            <div class="text-center my-3">
                                                <p><small>or</small></p>
                                                
                                                    <a class="btn-yellow-round-outline" href="{{ '/auth/redirect' }}"><i
                                                    class="bi bi-google"></i> Login with Google</a>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>

            
                                    <div class="row">
                                        <a href="{{ route('register') }}" class="text-center"><small><span class="text-dark">Don't
                                                    have an account
                                                    yet?</span>
                                                Register
                                                here</small></a>
                                    </div>
            
                                    {{-- <a class="btn btn-danger" href="{{ '/auth/redirect' }}">Login with Google</a> --}}
            
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</section>

@endsection