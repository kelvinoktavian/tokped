@extends('layouts.app')

@section('content')

<x-alert />

<div class="flex justify-center">
  <h4 class="pb-4">{{ $title }}</h4>

  <div class="card p-4">
    <div class="card-body">
      <form action="{{ route('address.store') }}" method="POST">

        @csrf

        <div class="mt-2">
          <div class="row py-2">
            <div class="col-md-6">

              <label for="province_id">Province</label>
              <select class="form-control" name="province_id" id="province_id" required>
                <option value="" holder>--Choose Province--</option>
                @foreach($provinces as $province)
                <option value="{{ $province->id }}">{{ $province->province }}</option>
                @endforeach
              </select>
              @error('province_id')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="city_id">City</label>
              <select class="form-control" name="city_id" id="city_id" required>
                <option value="" holder>--Choose City--</option>
              </select>
              @error('city_id')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>

          <div class="row py-2">
            <div class="col-md-6">
              <label for="street_name">Street Name</label>
              <input name="street_name" id="street_name" type="text" class="form-control"
                value="{{ old('street_name') }}" placeholder="Your full address" required>
              @error('street_name')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" id="postal_code"
                class="form-control @error('postal_code') is-invalid @enderror" required readonly
                {{ old('postal_code') }}>
              @error('postal_code')
              <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-dark btn-custom-primary">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection