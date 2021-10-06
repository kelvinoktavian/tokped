@extends('layouts.app')

@section('content')

<x-alert />

<div class="container mb-1">

  <div class="d-flex justify-content-between pb-4">
    <h4>My {{ $title }}</h4>
    <form action="{{ route('wishlist.clear') }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-dark btn-custom-primary">Clear Wishlist</button>
    </form>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="row">

        <div class="col-md-12">
          <div class="row">
            @foreach ($wishlists as $wishlist)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
              <div class="card rounded-3 border-0">
                <img src="{{ asset('images/product/' . $wishlist->image_path) }}" alt="{{ $wishlist->name }}"
                  width="100%" class="d-block" style="object-fit: cover">
                <div class="card-body">
                  <div class="mb-3" style="border-bottom: 0.2px solid rgb(230, 230, 230)">
                    <h5 class="font-weight-bold"><a href="{{ route('show_product', $wishlist->slug) }}"
                        class="text-dark text-decoration-none hovered">{{ $wishlist->name }}</a>
                    </h5>
                    <div class="d-flex justify-content-between">
                      <p class="text-muted text-md">Rp. {{ number_format($wishlist->price) }}</p>
                      <form class="d-block" action="/wishlist" method="POST">
                        @csrf
                        @if(in_array($wishlist->id, $check_wishlist))
                        @method('DELETE')
                        @endif
                        <input name="slug" type="hidden" value="{{ $wishlist->slug }}">
                        <button class="btn btn-sm btn-light font-weight-bold">
                          <i
                            class="bi bi-heart-fill @if(!in_array($wishlist->id, $check_wishlist)) text-secondary @else text-danger @endif"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                  @if ($wishlist->qty > 0)
                  <small class="d-block pb-2 text-info">Stock: {{ number_format($wishlist->qty) }}</small>
                  @else
                  <small class="d-block pb-2 text-danger">Product is out of stock.</small>
                  @endif
                  <small class="d-block pb-2 text-muted">{{ $wishlist->sold }} Sold |
                    {{ $wishlist->reviews()->count(); }} @if($wishlist->reviews()->count() <= 1) Review @else Reviews
                      @endif</small> <a href="{{ route('show_product', $wishlist->slug) }}"
                      class="btn btn-sm btn-dark btn-pill font-weight-bold">Detail</a>
                      <form class="d-inline" action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input name="slug" type="hidden" value="{{ $wishlist->slug }}">
                        <button
                          class="btn btn-sm btn-dark btn-pill {{ $wishlist->qty == 0 ? 'disabled' : '' }} font-weight-bold">
                          Add to cart
                        </button>
                      </form>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection