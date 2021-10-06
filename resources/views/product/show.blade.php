@extends('layouts.app')

@section('content')

<x-alert />

<div class="card card-solid">
  <div class="card-body">
    <a href="{{ route('product') }}" class="float-right"><i class="bi bi-chevron-left"></i>All Products</a>

    <div class="row">
      <div class="col-12 col-sm-6">
        <div class="col-12">
          <img src="{{ asset('images/product/' . $product->image_path) }}" class="product-image"
            alt="{{ $product->name }}">
        </div>
        <div class="col-12 product-image-thumbs">

          <div class="product-image-thumb active"><img src="{{ asset('images/product/' . $product->image_path) }}"
              alt="{{ $product->name }}"></div>

          @foreach($product_images as $product_image)
          <div class="product-image-thumb active"><img src="{{ asset('images/product/' . $product_image->image_path) }}"
              alt="{{ $product->name }}"></div>
          @endforeach

        </div>
      </div>
      <div class="col-12 col-sm-6">
        <h4 class="pt-5 pb-2 border-bottom font-weight-bold">{{ $product->name }}</h4>

        <div class="">
          <h5 class="mb-0 pt-2">
            Rp. {{ number_format($product->price) }}
          </h5>
        </div>

        <div class="mt-4">

          <form class="d-inline mr-2" action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input name="slug" type="hidden" value="{{ $product->slug }}">
            <button class="btn btn-sm btn-dark btn-pill {{ $product->qty == 0 ? 'disabled' : '' }} font-weight-bold">
              <i class="bi bi-cart-plus-fill"></i> Add to cart
            </button>
          </form>
          <form class="d-inline" action="/wishlist" method="POST">
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
          @if($product->qty == 0)
          <small class="d-block pt-3 text-danger">Product is out of stock.</small>
          @else
          <small class="d-block pt-3 text-info">Stock: {{ number_format($product->qty) }}</small>
          @endif
        </div>

        <div class="my-3">
          <p><strong>Brand: </strong><a href="/product?brand={{ $product->brand->id }}"
              class="text-primary"><span>{{ $product->brand->name }}</span></a></p>
          <p><strong>Category: </strong><a href="/product?category={{ $product->category->id }}"
              class="text-primary"><span>{{ $product->category->name }}</span></a></p>
          <p><strong>Capacity: </strong>{{ $product->voltage }} V | {{ $product->capacity }} Ah</p>
          <p><strong>Weight: </strong>{{ number_format($product->weight) }} gr</p>
          <strong>Description</strong>
          <p>{!! $product->description !!}</p>
        </div>

        <a href="https://wa.me/62895345228535?text=Hello, i'm interested with {{ $product->name }}" target="_blank"
          class="btn btn-sm d-inline-block btn-whatsapp">Chat
          us <i class="fab fa-whatsapp fa-lg"></i></a>

      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>

{{-- Product Reviews --}}
<h4 class="py-4 border-bottom">Reviews ({{ $reviews->count() }})</h4>
<div class="card card-widget">
  @forelse ($reviews as $review)
  <div class="card-footer card-comments border-bottom py-3">
    <div class="card-comment">
      <img class="img-circle img-sm" src="{{ asset('images/user/' . $review->user->image_path) }}" alt="User Image">
      <div class="comment-text">
        <span class="username">
          {{ $review->user->name }}
          <span class="text-muted float-right">{{ $review->created_at->diffForHumans() }}</span>
        </span>
        <div>
          <div class="d-flex justify-content-between">
            <p>{{ $review->body }}</p>

            @auth
            @if($review->user_id == auth()->user()->id)
            <form action="{{ route('review.destroy', $review->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-link m-0 p-0"><small>Delete</small></button>
            </form>
            @endif
            @endauth

          </div>
        </div>
      </div>
    </div>
  </div>
  @empty
  <div class="py-5 card-footer card-comments">
    <div class="card-comment">
      <div class="comment-text text-center">
        <small>No review yet.</small>
      </div>
    </div>
  </div>
  @endforelse
  @auth
  <div class="card-footer pt-3">
    <form action="{{ route('review.store') }}" method="POST">
      @csrf
      <img class="img-fluid img-circle img-sm" src="{{ asset('images/user/' . Auth::user()->image_path) }}"
        alt="{{ Auth::user()->name }}">
      <div class="img-push">
        <textarea name="body" type="text" class="form-control form-control-sm" placeholder="Your review here..."
          required></textarea>
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="slug" value="{{ $product->slug }}">
        @error('body')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <button type="submit" class="btn btn-sm btn-dark btn-custom-primary float-right mt-3">Publish</button>
      </div>
    </form>
  </div>
  @endauth
</div>
{{ $reviews->links() }}

{{-- Related Products --}}
@if($related_products->count() > 0)
<h4 class="py-4 border-bottom">Related Products</h4>
<div class="row">
  @foreach ($related_products as $product)
  <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
    <div class="card rounded-3 border-0">
      <img src="{{ asset('images/product/' . $product->image_path) }}" alt="{{ $product->name }}" width="100%"
        class="d-block" style="object-fit: cover">
      <div class="card-body">
        <div class="mb-3" style="border-bottom: 0.2px solid rgb(230, 230, 230)">
          <h5><a href="{{ route('show_product', $product->slug) }}"
              class="text-dark text-decoration-none hovered">{{ $product->name }}</a>
          </h5>
          <div class="d-flex justify-content-between">
            <p class="small text-muted">Rp. {{ number_format($product->price) }}</p>
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
        <small class="d-block pb-2 text-muted">0 Sold |
          {{ $product->reviews()->count(); }} @if($product->reviews()->count() <= 1) Review @else Reviews @endif</small>
            <a href="{{ route('show_product', $product->slug) }}" class="btn btn-sm btn-dark btn-pill font-weight-bold">
            Detail</a>
            <form class="d-inline" action="{{ route('cart.store') }}" method="POST">
              @csrf
              <input name="slug" type="hidden" value="{{ $product->slug }}">
              <button class="btn btn-sm btn-dark btn-pill {{ $product->qty == 0 ? 'disabled' : '' }} font-weight-bold">
                <i class="bi bi-cart-plus-fill"></i> Add to cart
              </button>
            </form>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif

@endsection