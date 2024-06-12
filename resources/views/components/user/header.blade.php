<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">

    <a href="/" class="logo d-flex align-items-center me-auto me-lg-0">
      <img src="{{ asset('/frontend/img/logo.png') }}" alt="">
    </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('products.index') }}">Products</a></li>
        <li><a href="/orders">Orders</a></li>
        <li><a href="/courses">Courses</a></li>
      </ul>
    </nav>

    @if (Route::has('login'))
    <div class="member d-flex align-items-center">
      @auth

      {{-- Notification icon --}}
      <a href="{{ url('/user/dashboard') }}" class="btn-book-a-table bi bi-bell"></a>

      {{-- Cart Icon with Count --}}
      <a href="{{ url('/cart') }}" class="btn-book-a-table bi bi-cart3">
        &nbsp;&nbsp;
        <span class="badge bg-danger">{{ $cartCount }}</span>
      </a>

      {{-- Profile icon --}}
      <a href="{{ url('/user/dashboard') }}" class="btn-book-a-table">My Profile</a>
      @else
      <a class="btn-book-a-table" href="{{ route('login') }}">Login or Register</a>
      @endauth
    </div>
    @endif

    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

  </div>
</header>
<!-- End Header -->