<!-- Vertical Navbar -->
<nav
  class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-dark bg-white border-bottom border-bottom-lg-0 border-end-lg"
  id="navbarVertical" style="background-color: #3B2621 !important">

  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse"
      aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
      <img src="{{ asset('frontend/img/footer-logo.png') }}" class="navbar-brand-img h-100 rounded" alt="..."
        style="width: 200px;">
    </a>
    <!-- User menu (mobile) -->
    <div class="navbar-user d-lg-none">
      <!-- Dropdown -->
      <div class="dropdown">
        <!-- Toggle -->
        <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          <div class="avatar-parent-child">
            <img alt="Image Placeholder"
              src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80"
              class="avatar avatar- rounded-circle">
            <span class="avatar-child avatar-badge bg-success"></span>
          </div>
        </a>
        <!-- Menu -->
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
          <a href="#" class="dropdown-item">Profile</a>
          <a href="#" class="dropdown-item">Settings</a>
          <a href="#" class="dropdown-item">Billing</a>
          <hr class="dropdown-divider">
          <a href="#" class="dropdown-item">Logout</a>
        </div>
      </div>
    </div>
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidebarCollapse">
      <!-- Navigation -->
      <ul class="navbar-nav">

        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house"></i> Dashboard
          </a>
        </li>

        {{-- Products - Dropdown --}}
        <li class="nav-item">
          <a class="nav-link" href="#navbarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="navbarProducts">
            <i class="bi bi-box"></i> Products
          </a>
          <div class="collapse" id="navbarProducts">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link">
                  Coffee
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.coffee-beans.index') }}" class="nav-link">
                  Coffee Beans
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.coffee-machines.index') }}" class="nav-link">
                  Coffee Machines
                </a>
              </li>
            </ul>
          </div>
        </li>

        {{-- Category --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="bi bi-tags"></i>
            Category
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="bi bi-cup-straw"></i>
            Coffee Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.orders-coffee-beans.index') }}">
            <i class="bi bi-handbag"></i>
            Bean Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.orders-coffee-machines.index') }}">
            <i class="bi bi-boxes"></i>
            Machine Orders
          </a>
        </li>

        {{-- Vouchers --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.vouchers.index') }}">
            <i class="bi bi-gift"></i>
            Vouchers
          </a>
        </li>

        {{-- Rooms --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.rooms.index') }}">
            <i class="bi bi-house"></i>
            Rooms
          </a>
        </li>

        {{-- Reservations --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.reservations.index') }}">
            <i class="bi bi-calendar"></i>
            Reservations
          </a>
        </li>

        {{-- Courses - Dropdown --}}
        <li class="nav-item">
          <a class="nav-link" href="#navbarCourses" data-bs-toggle="collapse" role="button" aria-expanded="false"
            aria-controls="navbarCourses">
            <i class="bi bi-book "></i> Courses
          </a>
          <div class="collapse" id="navbarCourses">
            <ul class="nav nav-sm flex-column">
              {{-- <li class="nav-item">
                <a href="{{ route('admin.courses.index') }}" class="nav-link">
                  Videos
                </a>
              </li> --}}
              <li class="nav-item">
                <a href="{{ route('admin.bootcamps.index') }}" class="nav-link">
                  Course
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-people"></i>
            Customers
          </a>
        </li> -->
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault(); this.closest('form').submit();">
              <i class="bi bi-box-arrow-right"></i> Logout
            </a>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>