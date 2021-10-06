@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-lg-6 col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }} {{ $category->name }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('category.update', $category->slug) }}" method="POST">

          @csrf
          @method('PATCH')

          <div class="form-group">
            <label for="name">Name
              <x-asterisk-required-symbol /></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') ?? $category->name }}" placeholder="Category name" autofocus>
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group float-right">
            <x-submit-button>
              Update
            </x-submit-button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection