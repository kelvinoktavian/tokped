@extends('layouts.app')

@section('content')

<x-alert />

@if ($carts->count() != 0)
<div class="container padding-bottom-3x mb-1 p-5">

  <div class="d-flex justify-content-between pb-4 border-bottom">
    <h2>My {{ $title }}</h2>
    <form action="{{ route('cart.clear') }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-dark-gold-round-outline">Clear Cart</button>
    </form>
  </div>

  <div class="table-responsive shopping-cart">
    <table class="table table-borderless">
      <thead>
        <tr>
          <th class="text-center">Product</th>
          <th class="text-center">Price</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($carts as $cart)
        <tr class="border-top">
          <td>
            <div class="product-item">
              <a class="product-thumb align-middle" href="{{ route('show_product', $cart->product->slug) }}"><img
                  src="{{ asset('images/product/' . $cart->product->image_path) }}"
                  alt="{{ $cart->product->name }}"></a>
              <div class="product-info">
                <h6 class="font-weight-bold"><a class="text-dark hovered"
                    href="{{ route('show_product', $cart->product->slug) }}">{{ $cart->product->name }}</a>
                </h6>
                <small class="d-block">Stock: <span
                    class="d-inline">{{ number_format($cart->product->qty) }}</span></small>
                <small class="d-block">Weight: <span class="d-inline">{{ number_format($cart->product->weight) }}
                    gr</span></small>
              </div>
            </div>
          </td>
          <td class="text-center text-md">Rp. {{ number_format($cart->product->price) }}</td>
          <td class="text-center">
            <div class="input-group">
              <input data-id="{{ $cart->id }}" data-price="{{ $cart->product->price }}" type="number" name="qty"
                class="form-control qty text-center" min="1" max="{{ $cart->product->qty }}" value="{{ $cart->qty }}">
            </div>

            @if($cart->qty >= $cart->product->qty)
            <small class="text-danger">Maximum total product!</small>
            @endif
          </td>
          <td class="text-center text-md">Rp. {{ number_format($cart->total_price) }}</td>
          <td class="text-center">
            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-link " title="Remove Cart"><i
                  class="fa fa-trash text-secondary fa-md"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="shopping-cart-footer">
    <div class="column text-lg">
      <h5>Total: Rp. {{ number_format($subtotal) }}</h5>
    </div>
  </div>

  <div class="shopping-cart-footer">
    <div class="column">
      <a class="btn text-decoration-none btn-custom-primary" href="{{ route('product') }}"><i
          class="icon-arrow-left"></i>Back to Shopping</a>
    </div>
    <div class="column">
      <form action="{{ route('checkout') }}" method="GET">
        <button type="submit" class="btn btn-dark btn-custom-primary">Checkout</button>
      </form>
    </div>
  </div>

</div>

@else

<div class="card p-5" style="height: 50vh;">
  <div class="card-body d-flex flex-column justify-content-center">
    <div class="">
      <h4 class="text-center font-weight-bold mb-3">Your cart is empty.</h4>
      <div class="text-center">
        <a class="btn btn-sm text-decoration-none btn-custom-primary" href="{{ route('product') }}">Shop Now</a>
      </div>
    </div>
  </div>
</div>

@endif

@endsection