@extends('layouts.app')

@section('content')

<x-alert />

<div class="flex justify-center container p-5">
  <h2 class="pb-4">{{ $title }}</h2>

  <div class="card p-4">
    <div class="card-body">
      <form action="{{ route('address.update', $user->address->id) }}" method="POST">

        @csrf
        @method('PATCH')

        <div class="mt-2">
          <div class="mb-4">
            <p class="font-weight-bold">{{ $user->name }}</p>
            <p>+62 {{ $user->phone }}</p>
          </div>

          <div class="row py-2">

            <div class="col-md-6">
              <label for="province_id">Province</label>
              <select class="form-control @error('province_id') is-invalid @enderror" name="province_id"
                id="province_id">
                <option value="{{ $user->address->province_id }}">{{ $user->address->province->province }}</option>
                @foreach($provinces as $province)
                @if($user->address->province_id != $province->id)
                <option value="{{ $province->id }}">{{ $province->province }}</option>
                @endif
                @endforeach
              </select>
              @error('province_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="city_id">City</label>
              <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city_id">
                <option value="{{ $user->address->city_id }}">{{ $user->address->city->city_name }}</option>
              </select>
              @error('city_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

          </div>

          <div class="row py-2">
            <div class="col-md-6">
              <label for="street_name">Street Name</label>
              <input name="street_name" id="street_name" type="text"
                class="form-control @error('street_name') is-invalid @enderror"
                value="{{ old('street_name') ?? $user->address->street_name }}">
              @error('street_name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" id="postal_code"
                class="form-control @error('postal_code') is-invalid @enderror"
                value="{{ old('postal_code') ?? $user->address->postal_code }}" required readonly>
              @error('postal_code')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="mt-3 row">
            <div class="col p-0"></div>
            <button type="submit" class="col btn-dark-gold-round-outline">Save</button>
            <div class="col p-0"></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection