@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-lg-6 col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }} for {{ $product->name }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('product_image.store', $product->slug) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="image_path">Image
              <x-asterisk-required-symbol /></label>
            <div class="input-group">
              <div class="custom-file">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                <input type="file" accept="image/*" onchange="loadFile(event)" name="image_path" type="file"
                  class="custom-file-input @error('image_path') is-invalid @enderror" id="image_path"
                  value="{{ old('image_path') }}">
                <label class="custom-file-label" for="image_path">Choose file</label>
              </div>
            </div>
            @error('image_path')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <img class="my-3" width="200px" id="output" />
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