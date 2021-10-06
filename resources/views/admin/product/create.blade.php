@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-md-9">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

          @csrf

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="brand_id">Brand
                  <x-asterisk-required-symbol /></label>
                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror"
                  autofocus>
                  <option value="">--Choose Brand--</option>
                  @foreach($brands as $brand)
                  <option value="{{ $brand->id }}" @if (old('brand_id')==$brand->id ) selected="selected" @endif>
                    {{ $brand->name }}</option>
                  @endforeach
                </select>
                @error('brand_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="category_id">Category
                  <x-asterisk-required-symbol /></label>
                <select name="category_id" id="category_id"
                  class="form-control @error('category_id') is-invalid @enderror">
                  <option value="">--Choose Category--</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" @if (old('category_id')==$category->id ) selected="selected"
                    @endif>{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="name">Name
              <x-asterisk-required-symbol /></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}" placeholder="Product name">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="row">
            <div class="col-6">
              <label for="price">Price
                <x-asterisk-required-symbol /></label>
              <div class="input-group mb-3">
                <span class="input-group-text">Rp.</span>
                <input min="1" type="number" name="price" id="price"
                  class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                  placeholder="Price">
                @error('price')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="qty">Qty
                  <x-asterisk-required-symbol /></label>
                <input min="1" type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror"
                  value="{{ old('qty') }}" placeholder="Qty">
                @error('qty')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-4">
              <label for="voltage">Voltage
                <x-asterisk-required-symbol /></label>
              <div class="input-group mb-3">
                <input min="1" type="number" name="voltage" id="voltage"
                  class="form-control @error('voltage') is-invalid @enderror" value="{{ old('voltage') }}"
                  placeholder="Voltage">
                <span class="input-group-text">V</span>
                @error('voltage')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <label for="capacity">Capacity
                <x-asterisk-required-symbol /></label>
              <div class="input-group mb-3">
                <input min="1" type="number" name="capacity" id="capacity"
                  class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}"
                  placeholder="Capacity">
                <span class="input-group-text">Ah</span>
                @error('capacity')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <label for="weight">Weight</label>
              <div class="input-group mb-3">
                <input min="1" type="number" name="weight" id="weight"
                  class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}"
                  placeholder="Weight">
                <span class="input-group-text">gr</span>
                @error('weight')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control ckeditor" id="description" cols="30"
              rows="10">{{ old('description') }}</textarea>
            @error('description')
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