@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-md-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">

          @csrf

          <div class="form-group">
            <label for="title">Title
              <x-asterisk-required-symbol /></label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title') }}" placeholder="Title" autofocus>
            @error('title')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="body">Body
              <x-asterisk-required-symbol /></label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body" cols="30"
              rows="10">{{ old('body') }}</textarea>
            @error('body')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="image_path">Image
              <x-asterisk-required-symbol /></label>
            <div class="input-group">
              <div class="custom-file">
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