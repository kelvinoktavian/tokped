@extends('admin.layouts.app')

@section('content')

<x-alert />

<h2>Welcome Back, <span class="font-weight-bold">{{ Auth::user()->name }}</span></h2>

<div class="row">
  <div class="col-8">

    <div class="row">
      <div class="col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $total_carousel }}</h3>

            <h4>Carousel</h4>
          </div>
          <div class="icon">
            <i class="bi bi-card-image"></i>
          </div>
          <a href="{{ route('carousel.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $total_category }}</h3>

            <h4>Category</h4>
          </div>
          <div class="icon">
            <i class="bi bi-card-list"></i>
          </div>
          <a href="{{ route('category.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{ $total_product }}</h3>

            <h4>Product</h4>
          </div>
          <div class="icon">
            <i class="bi bi-minecart"></i>
          </div>
          <a href="{{ route('product.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $total_order }}</h3>

            <h4>Order</h4>
          </div>
          <div class="icon">
            <i class="bi bi-bag-check-fill"></i>
          </div>
          <a href="{{ route('order.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <div class="small-box bg-indigo">
          <div class="inner">
            <h3>{{ $total_order_status }}</h3>

            <h4>Order Status</h4>
          </div>
          <div class="icon">
            <i class="bi bi-info-circle"></i>
          </div>
          <a href="{{ route('order_status.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-6">
        <div class="small-box bg-olive">
          <div class="inner">
            <h3>{{ $total_user }}</h3>

            <h4>User</h4>
          </div>
          <div class="icon">
            <i class="bi bi-person-fill"></i>
          </div>
          <a href="{{ route('user.index') }}" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection