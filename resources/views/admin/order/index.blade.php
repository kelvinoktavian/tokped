@extends('admin.layouts.app')

@section('content')

<x-alert />

<div class="row mb-3">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header font-weight-bold">
        <h3 class="card-title">Filter</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('order.index') }}" method="GET" role="search">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="search">User Name</label>
                <input id="search" name="search" type="text" class="form-control" placeholder="Search user..."
                  value="{{ request('search') }}">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="product">Product</label>
                <select name="product" id="product" class="form-control">
                  <option value="">--Choose Product--</option>
                  @if ($products->count() != 0)
                  @foreach($products as $product)
                  <option value="{{ $product->id }}" {{ ($product->id == request('product')) ? 'selected' : '' }}>
                    {{ $product->name }}
                  </option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                  <option value="">All</option>
                  @if ($order_statuses->count() != 0)
                  @foreach($order_statuses as $order_status)
                  <option value="{{ $order_status->id }}"
                    {{ ($order_status->id == request('status')) ? 'selected' : '' }}>
                    {{ $order_status->status }}
                  </option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="sortBy">Sort By</label>
                <select name="sortBy" id="sortBy" class="form-control">
                  <option value="">--Sort By--</option>
                  <option value="latest" {{ (request('sortBy') == 'latest') ? 'selected' : '' }}>Latest</option>
                  <option value="oldest" {{ (request('sortBy') == 'oldest') ? 'selected' : '' }}>Oldest</option>
                  <option value="highestTotalPrice" {{ (request('sortBy') == 'highestTotalPrice') ? 'selected' : '' }}>
                    Highest
                    Total
                    Price
                  </option>
                  <option value="lowestTotalPrice" {{ (request('sortBy') == 'lowestTotalPrice') ? 'selected' : '' }}>
                    Lowest
                    Total
                    Price
                  </option>
                  <option value="highestQuantity" {{ (request('sortBy') == 'highestQuantity') ? 'selected' : '' }}>
                    Highest
                    Quantity
                  </option>
                  <option value="lowestQuantity" {{ (request('sortBy') == 'lowestQuantity') ? 'selected' : '' }}>Lowest
                    Quantity
                  </option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Start Date</label>
                <div class="input-group date">
                  <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                  <input placeholder="Start Date" type="text" class="form-control px-2 datepicker" name="startDate"
                    value="{{ request('startDate') }}">
                </div>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label>End Date</label>
                <div class="input-group date">
                  <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                  <input placeholder="End Date" type="text" class="form-control px-2 datepicker" name="endDate"
                    value="{{ request('endDate') }}">
                </div>
              </div>
            </div>
          </div>

          <button class="btn btn-default btn-sm font-weight-bold" type="submit">
            <i class="bi bi-search"></i> Search
          </button>

          <a href="{{ route('order.index') }}">
            <button class="btn btn-danger btn-sm font-weight-bold" type="button">
              <i class="fas fa-sync-alt"></i> Reset
            </button>
          </a>

        </form>
      </div>
    </div>

  </div>
</div>

@if ($orders->count() != 0)

<div class="card">

  <div class="card-header">
    <h3 class="card-title">{{ $title }} List</h3>
    <h3 class="card-title float-right">Showing {{ $orders->total() }} @if($orders->total() <= 1) result @else results
        @endif</h3> </div> <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="10px" class="text-center">#</th>
                <th class="text-center">Date</th>
                <th class="text-center">Time</th>
                <th class="text-center">Username</th>
                <th>Product</th>
                <th class="text-center">Qty</th>
                <th>Total Price</th>
                <th width="300px">Shipping Address</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
              <tr>
                <td class="text-center align-middle">{{ ($no++) + 1 }}</td>
                <td class="align-middle text-center">{{ Carbon\Carbon::parse($order->created_at)->format('d F Y') }}
                </td>
                <td class="align-middle text-center">{{ Carbon\Carbon::parse($order->created_at)->format('H:i') }}</td>
                <td class="align-middle text-center"><a
                    href="{{ route('user.show', $order->username) }}">{{ $order->username }}</a>
                </td>
                <td class="align-middle"><a
                    href="{{ route('product.show', $order->slug) }}">{{ $order->product_name }}</a>
                </td>
                <td class="align-middle text-center">{{ $order->qty }}</td>
                <td class="align-middle">Rp. {{ number_format($order->total_price) }}</td>
                <td class="align-middle">{{ $order->street_name }}, {{ $order->type }} {{ $order->city_name }},
                  {{ $order->province }}, {{ $order->postal_code }}</td>
                <td class="align-middle text-center">

                  @if($order->order_status_id == 6)
                  <p class="text-danger align-middle">Canceled</p>
                  @elseif($order->order_status_id == 5)
                  <p class="text-info align-middle">Order Arrived</p>
                  @else
                  <form class="d-inline" action="{{ route('order.update', $order->id) }}" method="POST">

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                      <select name="order_status_id" id="order_status_id" class="form-control">
                        <option value="{{ $order->order_status_id }}">{{ $order->order_status }}</option>
                        @foreach($order_statuses as $order_status)
                        @if($order->order_status_id != $order_status->id)
                        <option value="{{ $order_status->id }}">{{ $order_status->status }}</option>
                        @endif
                        @endforeach
                      </select>
                      @error('order_status_id')
                      <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <x-submit-button>
                      Update
                    </x-submit-button>
                  </form>
                  @endif

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  </div>

  <div class="card-footer clearfix">
    {{ $orders->links() }}
  </div>
</div>

@else
<x-no-data-card>
  No order found.
</x-no-data-card>
@endif
@endsection