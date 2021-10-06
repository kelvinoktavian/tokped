@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-lg-6 col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }} {{ $brand->name }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('brand.update', $brand->slug) }}" method="POST" enctype="multipart/form-data">

          @csrf
          @method('PATCH')

          <div class="form-group">
            <label for="name">Name
              <x-asterisk-required-symbol /></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') ?? $brand->name }}" placeholder="Brand name" autofocus>
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="image_path">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" accept="image/*" onchange="loadFile(event)" name="image_path" type="file"
                  class="custom-file-input @error('image_path') is-invalid @enderror" id="image_path"
                  value="{{ old('image_path') }}">
                <label class="custom-file-label" for="image_path">{{ $brand->image_path }}</label>
              </div>
            </div>
            <img src="{{ asset('images/brand/' . $brand->image_path) }}" class="my-3 d-block" width="200px"
              id="output" />
            @error('image_path')
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