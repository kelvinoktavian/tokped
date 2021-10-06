@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-lg-6 col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('order_status.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label for="status">Status
              <x-asterisk-required-symbol /></label>
            <input type="text" name="status" id="status" class="form-control @error('status') is-invalid @enderror"
              value="{{ old('status') }}" placeholder="Status" autofocus>
            @error('status')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group float-right">
            <x-submit-button>
              Add
            </x-submit-button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection