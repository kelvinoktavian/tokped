@extends('layouts.app')

@section('content')

<x-alert />

<div class="container p-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <h2 class="pb-4">{{ $title }}</h2>
      <div class="card">
        <div class="card-body py-5">
          <form method="POST" action="{{ route('change-password.store') }}">
            @csrf

            <div class="form-group row py-1">
              <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

              <div class="col-md-6">
                <input id="password" type="password"
                  class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                  autocomplete="current-password">
                @error('current_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row py-1">
              <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

              <div class="col-md-6">
                <input id="new_password" type="password"
                  class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                  autocomplete="current-password">
                @error('new_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row py-1">
              <label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

              <div class="col-md-6">
                <input id="new_confirm_password" type="password"
                  class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password"
                  autocomplete="current-password">
                @error('new_confirm_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn-dark-gold-round-outline">
                  Update Password
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection