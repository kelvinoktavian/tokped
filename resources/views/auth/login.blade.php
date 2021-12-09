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
                            <div class="col">
                                <img src="{{ asset('images/img/welcome-image1.png') }}" alt="">
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group row py-1">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            
                                        <div class="col-md-6">
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
            
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="current-password">
            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
            
                                            <div class="form-check float-right mt-2">
                                                <input class="form-check-input" onclick="showPassword()" type="checkbox"
                                                    id="show-password">
            
                                                <label class="form-check-label" for="show-password">
                                                    <small>Show Password</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    <small>Remember me</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-dark btn-custom-primary">
                                                Login
                                            </button>
            
                                            @if (Route::has('password.request'))
                                            <a target="_blank" class="btn btn-link" href="{{ route('password.request') }}">
                                                <small>{{ __('Forgot Your Password?') }}</small>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="text-center my-3">
                                        <p><small>or</small></p>
                                        <a class="btn btn-danger font-weight-bold" href="{{ '/auth/redirect' }}"><i
                                                class="bi bi-google"></i> Login with
                                            Google</a>
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