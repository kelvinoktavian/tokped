<?php 
use App\Models\{Cart, Product};

// cari carts berdasarkan user_id
if(auth()->user() != NULL) {
  $carts = Cart::where('user_id', auth()->user()->id)
  ->pluck('product_id')
  ->toArray();
}      
?>

@extends('layouts.app')

@section('content')

<x-alert />

<div class="row">
  <div class="col-12">
    @if($products->total() != 0)
    <p class="float-right">Showing {{ $products->total() }} @if($products->total() <= 1) result @else results @endif</p>
        @endif </div> </div> <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-header bg-dark font-weight-bold">
              <i class="bi bi-funnel"></i> Filter
            </div>
            <div class="card-body">
              <form action="{{ route('product') }}" method="GET" role="search">
                <div class="form-group">
                  <label for="search">Product Name</label>
                  <input id="search" name="search" type="text" class="form-control" placeholder="Search product..."
                    value="{{ request('search') }}">
                </div>

                <div class="form-group">
                  <label for="brand">Brand</label>
                  <select name="brand" id="brand" class="form-control">
                    <option value="">--Choose Brand--</option>

                    @if ($brands->count() != 0)
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ ($brand->id == request('brand')) ? 'selected' : '' }}>
                      {{ $brand->name }}
                    </option>
                    @endforeach
                    @endif

                  </select>
                </div>

                <div class="form-group">
                  <label for="category">Category</label>
                  <select name="category" id="category" class="form-control">
                    <option value="">--Choose Category--</option>

                    @if ($categories->count() != 0)
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == request('category')) ? 'selected' : '' }}>
                      {{ $category->name }}</option>
                    @endforeach
                    @endif

                  </select>
                </div>

                <div class="form-group">
                  <label for="minPrice">Min Price</label>
                  <input id="minPrice" name="minPrice" type="number" min="1" class="form-control priceFilter"
                    value="{{ request('minPrice') }}" placeholder="Mininum Price">
                </div>

                <div class="form-group">
                  <label for="maxPrice">Max Price</label>
                  <input id="maxPrice" name="maxPrice" type="number" min="1" class="form-control"
                    value="{{ request('maxPrice') }}" placeholder="Maximum Price">
                </div>

                <div class="form-group">
                  <label for="sortBy">Sort By</label>
                  <select name="sortBy" id="sortBy" class="form-control">
                    <option value="">--Sort By--</option>
                    <option value="newest" {{ (request('sortBy') == 'newest') ? 'selected' : '' }}>Newest</option>
                    <option value="highestPrice" {{ (request('sortBy') == 'highestPrice') ? 'selected' : '' }}>Highest
                      Price
                    </option>
                    <option value="lowestPrice" {{ (request('sortBy') == 'lowestPrice') ? 'selected' : '' }}>Lowest
                      Price
                    </option>
                    <option value="bestSeller" {{ (request('sortBy') == 'bestSeller') ? 'selected' : '' }}>Best Seller
                    </option>
                  </select>
                </div>

                <button class="btn btn-dark btn-sm rounded-pill font-weight-bold" type="submit">
                  <i class="bi bi-search"></i> Search
                </button>

                <a href="{{ route('product') }}">
                  <button class="btn btn-dark btn-sm rounded-pill font-weight-bold" type="button">
                    <i class="fas fa-sync-alt"></i> Reset
                  </button>
                </a>

              </form>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          @if ($products->count() != 0)
          <div class="row">
            @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
              <div class="card rounded-3 border-0">
                <img src="{{ asset('images/product/' . $product->image_path) }}" alt="{{ $product->name }}" width="100%"
                  class="d-block" style="object-fit: cover">
                <div class="card-body">
                  <div class="mb-3" style="border-bottom: 0.2px solid rgb(230, 230, 230)">
                    <h5 class="font-weight-bold"><a href="{{ route('show_product', $product->slug) }}"
                        class="text-dark text-decoration-none hovered">{{ $product->name }}</a>
                    </h5>
                    <div class="d-flex justify-content-between">
                      <p class="text-muted text-md">Rp. {{ number_format($product->price) }}</p>
                      <form class="d-block" action="/wishlist" method="POST">
                        @csrf
                        @if(in_array($product->id, $check_wishlist))
                        @method('DELETE')
                        @endif
                        <input name="slug" type="hidden" value="{{ $product->slug }}">
                        <button class="btn btn-sm btn-light font-weight-bold">
                          <i
                            class="bi bi-heart-fill @if(!in_array($product->id, $check_wishlist)) text-secondary @else text-danger @endif"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                  @if ($product->qty > 0)
                  <small class="d-block pb-2 text-info">Stock: {{ number_format($product->qty) }}</small>
                  @else
                  <small class="d-block pb-2 text-danger">Product is out of stock.</small>
                  @endif
                  <small class="d-block pb-2 text-muted">{{ $product->sold }} Sold |
                    {{ $product->reviews()->count(); }} @if($product->reviews()->count() <= 1) Review @else Reviews
                      @endif</small> <a href="{{ route('show_product', $product->slug) }}"
                      class="btn btn-sm btn-dark btn-pill font-weight-bold">Detail</a>
                      <form class="d-inline" action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input name="slug" type="hidden" value="{{ $product->slug }}">
                        <button
                          class="btn btn-sm btn-dark btn-pill {{ $product->qty == 0 ? 'disabled' : '' }} font-weight-bold">
                          <i class="bi bi-cart-plus-fill"></i> Add to cart
                        </button>
                      </form>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @else
          <x-no-data-card>
            No product found.
          </x-no-data-card>
          @endif
          <div class="d-flex justify-content-center">
            {{ $products->links() }}
          </div>
        </div>
  </div>

  @endsection