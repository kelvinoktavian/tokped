<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('images/user/' . Auth::user()->image_path) }}" class="img-circle img-sm"
        alt="{{ Auth::user()->name }}">
    </div>
    <div class="info">
      <span class="text-light">{{ Auth::user()->name }}</span>
      <span class="d-block badge rounded-pill bg-warning text-dark">Admin</span>
    </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="{{ route('admin.home') }}" class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}">
          <i class="bi bi-house-door text-lg"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('carousel.index') }}" class="nav-link {{ request()->is('admin/carousel*') ? 'active' : '' }}">
          <i class="bi bi-card-image text-lg"></i>
          <p>
            Carousel
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('category.index') }}" class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}">
          <i class="bi bi-card-list text-lg"></i>
          <p>
            Category
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('product.index') }}" class="nav-link {{ request()->is('admin/product*') ? 'active' : '' }}">
          <i class="bi bi-minecart text-lg"></i>
          <p>
            Product
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('order.index') }}" class="nav-link {{ request()->is('admin/order') ? 'active' : '' }}">
          <i class="bi bi-bag-check-fill text-lg"></i>
          <p>
            Order
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('order_status.index') }}"
          class="nav-link {{ request()->is('admin/order_status*') ? 'active' : '' }}">
          <i class="bi bi-info-circle text-lg"></i>
          <p>
            Order Status
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}">
          <i class="bi bi-person-fill text-lg"></i>
          <p>
            User
          </p>
        </a>
      </li>

      <li>
        <hr class="dropdown-divider">
      </li>

      <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
          <i class="bi bi-display text-lg"></i>
          <p>
            Home Page
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();"
          class="nav-link">
          <i class="bi bi-box-arrow-right text-lg"></i>
          <p>
            Logout
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
        </form>
      </li>
    </ul>
  </nav>
</div>