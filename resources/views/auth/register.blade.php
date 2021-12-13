<?php 
$title = 'Register';
$active = 'register';
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
                                <h2>Register</h2>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
            
                                    <div class="form-group row py-1">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
            
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row py-1">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" autocomplete="email">
            
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row py-1">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
            
                                        <div class="col-md-6">
                                            <input id="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror" name="username"
                                                value="{{ old('username') }}" autocomplete="username">
            
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row py-1">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password">
            
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row py-1">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                            Password</label>
            
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" required>
            
                                                <label class="form-check-label">
                                                    <small>I agree to the terms of service.</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn-dark-round-outline">
                                                Register
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6 offset-md-4 mt-3 p-0">
                                        <div class="row">
                                            <a href="{{ route('register') }}" class="text-center">
                                                <small class="text-dark">Already have an account?</small>
                                                <small class="yellow-underline">Login here</small>
                                            </a>
                                            
                                        </div>  
                                    </div>
            
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
</section>
@endsection