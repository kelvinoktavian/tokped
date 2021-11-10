@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-md-9">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $title }} {{ $product->name }}</h3>
        <x-back-button />
      </div>

      <div class="card-body">

        <form action="{{ route('product.update', $product->slug) }}" method="POST" enctype="multipart/form-data">

          @csrf
          @method('PATCH')

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="category_id">Category
                  <x-asterisk-required-symbol />
                </label>
                <select name="category_id" id="category_id" class="form-control">
                  <option value="{{ $product->category->id }}" @if (old('category_id')==$product->category->id )
                    selected="selected"
                    @endif>{{ $product->category->name }}</option>
                  @foreach($categories as $category)
                  @if($product->category->id != $category->id)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endif
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
              <x-asterisk-required-symbol />
            </label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') ?? $product->name }}" placeholder="Product name">
            @error('name')
            <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="row">
            <div class="col-6">
              <label for="price">Price
                <x-asterisk-required-symbol />
              </label>
              <div class="input-group mb-3">
                <span class="input-group-text">Rp.</span>
                <input min="1" type="number" name="price" id="price"
                  class="form-control @error('price') is-invalid @enderror"
                  value="{{ old('price') ?? $product->price }}" placeholder="Price">
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
                  <x-asterisk-required-symbol />
                </label>
                <input min="1" type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror"
                  value="{{ old('qty') ?? $product->qty }}" placeholder="Qty">
                @error('qty')
                <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <label for="weight">Weight</label>
              <div class="input-group mb-3">
                <input min="1" type="number" name="weight" id="weight"
                  class="form-control @error('weight') is-invalid @enderror"
                  value="{{ old('weight') ?? $product->weight }}" placeholder="Weight">
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
              rows="10">{{ old('description') ?? $product->description }}</textarea>
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
                <label class="custom-file-label" for="image_path">{{ $product->image_path }}</label>
              </div>
            </div>
            @error('image_path')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <img src="{{ asset('images/product/' . $product->image_path) }}" class="my-3 d-block" width="200px"
              id="output" />
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