@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
  <div class="col-md-8">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <p>{{ $message }}</p>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <p>{{ $message }}</p>
    </div>
    @endif
  </div>
</div>

<div class="container padding-bottom-3x mb-1">

  <h4 class="pb-4 border-bottom">{{ $title }}</h4>

  <div class="card">
    <div class="card-header">
      <p class="text-bold"><i class="bi bi-geo-alt-fill"></i> Shipping Address</p>
    </div>
    <div class="card-body">
      <p><strong>{{ auth()->user()->name }}</strong> (+62 {{ auth()->user()->phone }})</p>
      <small>{{ $user->address->street_name }}, {{ $user->address->city->type }}
        {{ $user->address->city->city_name }},
        {{ $user->address->province->province }}, {{ $user->address->postal_code }}</small>
      <a href="{{ route('address.index') }}" class="btn btn-dark float-right"><i class="bi bi-pencil-square"></i></a>
    </div>
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
              </div>
            </div>
          </td>
          <td class="text-center text-md">Rp. {{ number_format($cart->product->price) }}</td>
          <td class="text-center">{{ $cart->qty }}</td>
          <td class="text-center text-md">Rp. {{ number_format($cart->total_price) }}</td>
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

  <div class="card">
    <div class="card-header">
      <p class="text-bold"><i class="bi bi-credit-card"></i> Payment Method</p>
    </div>
    <div class="card-body">
      <img draggable="false" width="60px" src="{{ asset('images/logo/bca.png') }}" alt="BCA" class="d-inline">
      <p class="d-inline">Bank Transfer</p>
      <small class="d-block">Transfer to 928423424 a.n. Kelvin Oktavian</small>
    </div>
  </div>

  <div class="shopping-cart-footer">
    <div class="column">
      <a class="btn text-decoration-none btn-custom-primary" href="{{ route('cart.index') }}">Back to
        Cart</a>
    </div>
    <div class="column">
      <form action="{{ route('user_order.store') }}" method="POST">
        @csrf
        <button class="btn btn-dark btn-custom-primary">Create Order</button>
      </form>
    </div>
  </div>

</div>

@endsection