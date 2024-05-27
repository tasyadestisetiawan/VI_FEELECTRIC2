@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <div class="row">

        <div class="col-5">
          <div class="card rounded-4 shadow-sm" style="border: solid 1px #3b2621;">
            <div class="card-header bg-white border-0 mt-2">
              <div class="card bg-white border-0" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-3">
                    <img src="https://i0.wp.com/www.cssscript.com/wp-content/uploads/2020/12/Customizable-SVG-Avatar-Generator-In-JavaScript-Avataaars.js.png?fit=438%2C408&ssl=1" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-9">
                    <div class="card-body">
                      <h5 class="card-title">
                        {{ Auth::user()->name }}
                      </h5>
                      <small>
                        Registered since {{ Auth::user()->created_at->diffForHumans() }}
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body mx-2">

              <!-- CTA -->
              <div class="row">
                <div class="card rounded-4" style="background-color: #fceae3;">
                  <div class="card-body">
                    <h5 class="card-title mt-3">
                      Nikmatin Bebas Ongkir, tanpa batas!
                    </h5>
                    <p>
                      Belanja sepuasnya dan nikmati bebas ongkir tanpa batas minimal belanja.
                    </p>
                  </div>
                </div>
              </div>

              <!-- Gopay -->
              <div class="row mt-2">
                <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
                  <div class="card-body">
                    <div class="gopay d-flex align-items-center py-2">
                      <img src="{{ asset('frontend/img/icons/gopay.png') }}" alt="Gopay" class="img-fluid pe-3" style="width: 50px;"></i> <span class="ms-2">Gopay</span>
                      <p class="btn text-success ms-auto mb-0">Aktifkan</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Member Card -->
              <div class="row mt-2">
                <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
                  <div class="card-body">
                    <div class="member-card d-flex align-items-center py-2">
                      <img src="{{ asset('frontend/img/icons/payment.png') }}" alt="Gopay" class="img-fluid pe-3" style="width: 50px;"></i> <span class="ms-2">Member Card</span>
                      <p class="btn text-success ms-auto mb-0">Aktifkan</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Saldo -->
              <div class="row mt-2">
                <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
                  <div class="card-body">
                    <div class="saldo d-flex align-items-center py-2">
                      <img src="{{ asset('frontend/img/icons/saldo.png') }}" alt="Gopay" class="img-fluid pe-3" style="width: 50px;"></i> <span class="ms-2">Saldo</span>
                      <span class="ms-auto fw-bold">Rp. 50.000</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-7">
          <div class="card rounded-4 shadow-sm w-100" style="border: solid 1px #3b2621;">
            <div class="card-header bg-white border-0 mt-2">
              <ul class="nav nav-pills gap-3">
                <li class="nav-item">
                  <a class="nav-link active rounded-pill" style="background-color: #fff7e8;  color: #3b2621;" href="{{route('user.profile')}}">
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621" href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active rounded-pill" style="background-color: #3b2621;  color: #fff7e8;" href="{{route('user.address')}}">Address</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621" href="#latteNonCoffe">Vouchers</a>
                </li>
              </ul>
            </div>
            <div class="card-body mx-2">
              <div class="row">
                <div class="col-12">
                  <h5 class="fw-bold">Address</h5>
                  <p>
                    Manage your address here.
                  </p>
                </div>

                @forelse($data as $item)
                <div class="card rounded-4 mx-2 pt-2">
                  <div class="card-body">
                    <h6 class="card-title">
                      <!-- Radio Checked -->
                      <input type="radio" name="address" id="address" checked>
                      Address <span class="badge rounded bg-success">
                        Home
                      </span>
                    </h6>
                    <p>
                      {{ $item->address }}
                    </p>
                    <!-- Edit Button -->
                    <a href="{{ route('user.address.edit', $item->id) }}" style="color: #3b2621; text-decoration: none;">
                      Update Address
                    </a>
                  </div>
                </div>
                @empty
                <p>No addresses found.</p>
                @endforelse

                <div class="row mt-3">
                  <div class="col-12">
                    <button type="button" class="btn rounded-4" style="background-color: #3b2621; color: #fff7e8;" data-bs-toggle="modal" data-bs-target="#newAddress">
                      Add New Address
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal New Address -->
<div class="modal fade" id="newAddress" tabindex="-1" aria-labelledby="newAddressLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newAddressLabel">New Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-2">
        <form action="{{ route('user.address.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
              <option selected disabled>Select Type</option>
              <option value="Home">Home</option>
              <option value="Office">Office</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <button type="submit" class="btn rounded-4" style="background-color: #3b2621; color: #fff7e8;">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection