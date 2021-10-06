@extends('layouts.app')

@section('content')

<x-alert />

@if($check_orders->count() > 0)
<h4 class="pb-4 border-bottom">My {{ $title }}</h4>
@endif

@if($outstanding_payment > 0)
<div class="my-3">
  <p class="d-inline mr-2">Outstanding Payment: <span class="font-weight-bold">Rp.
      {{ number_format($outstanding_payment) }}</span></p>
  <a href="https://wa.me/62895345228535?text=Hello, i'm {{ auth()->user()->name }} want to send proof of payment with amount of Rp. {{ number_format($outstanding_payment) }}"
    target="_blank" class="btn btn-sm d-inline btn-whatsapp">Send Proof of Payment
    <i class="fab fa-whatsapp fa-lg"></i></a>
</div>
@endif

@if($check_orders->count() > 0)
<div class="my-3 d-flex align-items-center">
  <p class="my-auto mr-2">Status</p>
  <a class="mx-2 btn btn-sm btn-light btn-pill font-weight-bold {{ (request('status') == NULL ) ? 'btn-dark' : 'btn-light' }}"
    href="{{ route('user_order.index') }}">All</a>
  @foreach($order_statuses as $order_status)
  <a class="mx-2 btn btn-sm btn-pill font-weight-bold {{ ($order_status->id == request('status')) ? 'btn-dark' : 'btn-light' }}"
    href="/order?status={{ $order_status->id }}">{{ $order_status->status }}</a>
  @endforeach
</div>
@endif

@if ($orders->count() != 0)

@foreach ($orders as $order)
<div class="card my-3">
  <div class="card-body p-3">
    <ul class="products-list product-list-in-card pl-2 pr-2">
      <li class="item">

        <div class="d-flex justify-content-between align-items-center mb-3">
          <p class="my-auto">{{ $order->created_at->format('d F Y') }}</p>
          <div class="{{ ($order->order_status->status == 'Canceled') ? 'bg-danger' : 'bg-dark' }} px-2 py-1"
            style="border-radius: 5px;">
            <p class="text-light my-auto"><small class="font-weight-bold">{{ $order->order_status->status }}</small></p>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-2">
            <img src="{{ asset('images/product/' . $order->product->image_path) }}" alt="{{ $order->product->name }}"
              class="img-thumbnail mx-auto" width="100%">
          </div>

          <div class="col-sm-10">
            <div>
              <h6 class="mb-1 font-weight-bold"><a class="text-dark hovered"
                  href="{{ route('show_product', $order->product->slug) }}">{{ $order->product->name }}</a>
              </h6>
              <div class="d-flex flex-column">
                <p class="m-0 text-muted">Rp. {{ number_format($order->product->price) }}</p>
                <small class="m-0">Total Item: {{ $order->qty }}</small>

                <h6 class="text-bold mt-3 mb-1">Shipping Address</h6>
                <small class="m-0">{{ $order->street_name }}, {{ $order->city->type }} {{ $order->city->city_name }},
                  {{ $order->province->province }}, {{ $order->postal_code }}
                </small>
              </div>
            </div>
          </div>

        </div>

        <div class="row align-items-center my-3">

          <div class="col-sm-8">
            @if($order->order_status_id == 1)
            <small class="float-left text-danger"><i class="bi bi-exclamation-circle"></i> Please transfer via BCA to
              928423424
              a.n. Kelvin Oktavian before {{ $order->created_at->addDays(1)->toDayDateTimeString() }}, after
              that we will
              canceled your order</small>
            @endif
          </div>

          <div class="col-sm-4">
            <h5 class="float-right">Total: Rp. {{ number_format($order->total_price) }}</h5>
          </div>

        </div>

      </li>
    </ul>
  </div>
</div>
@endforeach
<div class="d-flex justify-content-center">
  {{ $orders->links() }}
</div>

@else

<div class="card p-5" style="height: 50vh;">
  <div class="card-body d-flex flex-column justify-content-center">
    <div class="">
      <h4 class="text-center font-weight-bold mb-3">
        @if($check_orders->count() > 0)
        No order found.
        @else
        You have no order yet.
        @endif
      </h4>
      @if($check_orders->count() == 0)
      <div class="text-center">
        <a class="btn btn-sm text-decoration-none btn-custom-primary" href="{{ route('product') }}">Shop Now</a>
      </div>
      @endif
    </div>
  </div>
</div>

@endif

@endsection