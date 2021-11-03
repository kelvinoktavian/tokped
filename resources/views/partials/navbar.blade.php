<?php 
use App\Models\Cart;
use App\Models\Wishlist;

if(Auth::user() != NULL) {
  $carts = Cart::where('user_id', auth()->user()->id)->get();
  $total_cart = $carts->sum('qty');

  $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
  $total_wishlist = $wishlists->count();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}" class="mr-5">
      <img src="{{ asset('images/img/logo.png') }}" alt="Souvenir Boss" style="width: 75px;" class="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active font-weight-bold' : '' }}"
            href="{{ route('home') }}">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('about') ? 'active font-weight-bold' : '' }}"
            href="{{ route('about') }}">About
            Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->is('product*') ? 'active font-weight-bold' : '' }}"
            href="{{ route('product') }}">Our Products</a>
        </li>

        @auth
        <li class="nav-item">
          <a class="nav-link {{ request()->is('order*') ? 'active font-weight-bold' : '' }}"
            href="{{ route('user_order.index') }}">My Orders</a>
        </li>

        <li class="nav-item mr-3">
          <a href="{{ route('cart.index') }}" class="btn btn-dark" style="background-color: #000000; border: 0">
            <i class="bi bi-cart-fill text-lg"></i> <span class="badge bg-danger">{{ $total_cart }}</span>
          </a>
        </li>
        @endauth
      </ul>

      <ul class="navbar-nav ml-auto">
        @guest

        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link {{ request()->is('login') ? 'active font-weight-bold' : '' }}"
            href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link {{ request()->is('register') ? 'active font-weight-bold' : '' }}"
            href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @endguest

        @auth
        <li class="nav-item dropdown">
          <img src="{{ asset('images/user/' . Auth::user()->image_path) }}" width="50px"
            class="img-fluid img-circle img-sm" alt="{{ Auth::user()->name }}">
          <a class="nav-link dropdown-toggle d-inline" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Welcome back, <strong>{{ Auth::user()->name }}</strong>
          </a>
          <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

            <li>
              <a class="dropdown-item text-light {{ request()->is('profile*') ? 'active' : '' }} hovered"
                href="{{ route('profile.index') }}"><i class="bi bi-person-fill"></i> My
                Profile</a>
            </li>
            <li>
              <a class="dropdown-item text-light {{ request()->is('address*') ? 'active' : '' }} hovered"
                href="{{ route('address.index') }}"><i class="bi bi-geo-alt-fill"></i> My
                Address</a>
            </li>

            @if(auth()->user()->is_google == 0)
            <li>
              <a class="dropdown-item text-light {{ request()->is('change-password*') ? 'active' : '' }} hovered"
                href="{{ route('change-password.index') }}"><i class="bi bi-lock-fill"></i> Change Password</a>
            </li>
            @endif

            @if(count($wishlists) > 0)
            <li>
              <a class="dropdown-item text-light {{ request()->is('wishlist*') ? 'active' : '' }} hovered"
                href="{{ route('wishlist.index') }}"><i class="bi bi-heart-fill"></i> My Wishlist <span
                  class="badge bg-danger">{{ $total_wishlist}}</span></a>
            </li>
            @endif


            <li>
              <hr class="dropdown-divider">
            </li>

            @if(auth()->user()->is_admin == 1)
            <li>
              <a class="dropdown-item text-light hovered" href="{{ route('admin.home') }}"><i
                  class="bi bi-person-badge-fill"></i> Admin Page</a>
            </li>
            @endif


            <li><a class="dropdown-item text-light hovered" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        @endauth

      </ul>
    </div>
  </div>
</nav>