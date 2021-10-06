@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-lg-8">
    <div class="card">

      <div class="card-header">
        <h3 class="card-title">{{ $product->name }}</h3>
        <a href="{{ route('product_image.index', $product->slug) }}" class="float-right btn btn-sm btn-info">Images</a>
        <a href="{{ route('product.edit', $product->slug) }}" class="float-right btn btn-sm btn-warning mx-2">Edit</a>
        <x-back-button />
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <img width="250px" class="img-thumbnail" src="{{ asset('images/product/' . $product->image_path) }}"
              alt="{{ $product->name }}">
          </div>
          <div class="col-md-9">
            @if ($product->qty == 0)
            <p class="text-danger"><i class="bi bi-exclamation-circle"></i> Product is out of stock</p>
            @endif
            <p><span class="text-bold">Brand</span>: {{ $product->brand->name }}</p>
            <p><span class="text-bold">Category</span>: {{ $product->category->name }}</p>
            <p><span class="text-bold">Price</span>: Rp. {{ number_format($product->price) }}</p>
            <p><span class="text-bold">Voltage</span>: {{ $product->voltage }} V (Volt)</p>
            <p><span class="text-bold">Capacity</span>: {{ $product->capacity }} Ah (Ampere Hour)</p>
            @if ($product->weight != NULL)
            <p><span class="text-bold">Weight</span>: {{ number_format($product->weight) }} gr</p>
            @endif

            @if ($product->qty > 0)
            <p><span class="text-bold">Stock</span>: {{ number_format($product->qty) }} @if($product->qty == 1) pc @else
              pcs @endif</p>
            @endif <p><span class="text-bold">Sold</span>: {{ $product->sold }} @if($product->sold <= 1) pc @else pcs
                @endif</p> @if ($product->description != NULL)
                <p><span class="text-bold">Description</span>: </p>{!! $product->description !!}
                @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection