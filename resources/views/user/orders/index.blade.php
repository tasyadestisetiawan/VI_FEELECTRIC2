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

                      <!-- Sum Saldo -->
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
                  <a class="nav-link rounded-pill border-2" style="background-color: #3b2621; color: #fff" href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621" href="{{route('user.address')}}">Address</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621" href="#latteNonCoffe">Vouchers</a>
                </li>
              </ul>
            </div>
            <div class="card-body mx-2">

              <!-- Table -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($orders as $order)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $order->order_id }}</td>
                    <td>Rp. {{ number_format($order->total) }}</td>
                    <td>
                      <a class="btn btn-sm" style="background-color: #3b2621; color: #fff;" href="{{ route('orders.show', $order->id) }}">Detail</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">
                      <img src="{{ asset('frontend/img/notfound.png') }}" alt="Empty" class="img-fluid" style="width: 100px;">
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection