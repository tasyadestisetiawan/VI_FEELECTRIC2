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
                  <li><a href="{{ route('orders.index') }}">Orders</a></li>
                  <li><a href="/courses">Courses</a></li>
              </ul>
          </nav>

          @if (Route::has('login'))
          <div class="member d-flex align-items-center">
              @auth
                @if (Auth::user()->role == 'admin')
                    <a href="{{ url('/admin/dashboard') }}" class="btn-book-a-table">Dashboard</a>
                @else
                    <a href="#" class="btn-book-a-table" data-bs-toggle="modal" data-bs-target="#notificationModal">
                        <i class="bi bi-bell"></i>
                    </a>
                    <a href="{{ route('cart.index') }}" class="btn-book-a-table bi bi-cart3">&nbsp;&nbsp;
                        <span class="badge bg-light text-dark">{{ App\Models\Cart::count() }}</span>
                    </a>
                    <a href="{{ url('/user/profile') }}" class="btn-book-a-table">My Profile</a>
                @endif
              @else
              <a class="btn-book-a-table" href="{{ route('login') }}">Login or Register</a>
              @endauth
          </div>
          @endif

          <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
          <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      </div>
  </header>

  <!-- Modal Notification -->
  <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <ul class="list-group list-group-flush">
                      <!-- Dummy Static -->
                      <li class="list-group list-group-flush">
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1">New Order</h5>
                                  <small>3 days ago</small>
                              </div>
                              <p class="mb-1">You have new order from customer</p>
                          </a>
                      </li>
                      <li class="list-group list-group-flush">
                          <a href="#" class="list-group-item list-group-item-action">
                              <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1">New Order</h5>
                                  <small>3 days ago</small>
                              </div>
                              <p class="mb-1">You have new order from customer</p>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <!-- End Modal Notification -->

  <!-- End Header -->