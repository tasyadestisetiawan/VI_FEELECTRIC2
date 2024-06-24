@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">

    {{-- Alert Notifications --}}
    <x-alert type="success" :message="session('success')" />
    <x-alert type="danger" :errors="$errors->all()" />

    <div class="row">
      <div class="col-md-5">
        <div class="card rounded-4 shadow-sm" style="border: solid 1px #3b2621;">
          <div class="card-header bg-white border-0 mt-2">
            <div class="card bg-white border-0" style="max-width: 540px;">
              <div class="row g-0">
                <div class="col-md-3">
                  <img src="{{ asset('storage/img/avatars/' . Auth::user()->avatar) }}" class="img-fluid rounded-start" alt="User Avatar">
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

            <!-- Gopay -->
            <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff; margin-top: 20px;">
              <div class="card-body">
                <div class="gopay d-flex align-items-center py-2">
                  <img src="{{ asset('frontend/img/icons/coins.png')}}" alt="Coins" class="img-fluid pe-3" style="width: 50px;">
                  <span class="ms-2">Coins</span>
                  <p class="btn fw-bold ms-auto mb-0">
                    {{ Auth::user()->coin }} <i class="bi bi-coin"></i>
                  </p>
                </div>
              </div>
            </div>

            <!-- Member Card -->
            <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff; margin-top: 20px;">
              <div class="card-body">
                <div class="member-card d-flex align-items-center py-2">
                  <img src="{{ asset('frontend/img/icons/member.png') }}" alt="Member Card" class="img-fluid pe-3" style="width: 50px;">
                  <span class="ms-2">Member Card</span>
                  <p class="btn text-success ms-auto mb-0">
                    Activation
                  </p>
                </div>
              </div>
            </div>

            <!-- Saldo -->
            <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff; margin-top: 20px;">
              <div class="card-body">
                <div class="saldo d-flex align-items-center py-2">
                  <img src="{{ asset('frontend/img/icons/wallet.png') }}" alt="Saldo" class="img-fluid pe-3" style="width: 50px;">
                  <span class="ms-2">Saldo</span>
                  <span class="ms-auto fw-bold">Rp. 50.000</span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-md-7">
        <div class="card rounded-4 shadow-sm w-100" style="border: solid 2px #3b2621;">
          <div class="card-header bg-white border-0 mt-2">
            <ul class="nav nav-pills gap-3">
              <li class="nav-item">
                <a class="nav-link active rounded-pill" style="background-color: #fff7e8; color: #3b2621;" href="{{ route('user.profile') }}">
                  Profile
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621;" href="{{ route('orders.index') }}">
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621;" href="{{ route('user.reservations.my') }}">
                  Reservations
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621;" href="{{ route('user.address') }}">
                  Address
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link rounded-pill border-2" style="background-color: #3b2621; color: #fff7e8;" href="{{ route('vouchers.index') }}">
                  Vouchers
                </a>
              </li>
            </ul>
          </div>
          <div class="card-body mx-2">
            <div class="row">
              @foreach ( $vouchers as $voucher )
              <div class="col-12">
                <div class="card rounded-4 mb-3 shadow-sm" style="background-color: #f0f9ff; border: solid 2px #3b2621; border-style: dashed;">
                  <div class="card-body">
                    <span class="fw-bold">
                      {{ $voucher->name }}
                    </span>
                    <div class="voucher d-flex align-items-center py-2">
                      <span class="ms-2 voucher-code">{{ $voucher->code }}</span>
                      {{-- Copy Button --}}
                      <div class="ms-auto">
                        <button class="btn btn-sm btn-outline-dark" onclick="copyToClipboard('{{ $voucher->code }}')" title="Copy to Clipboard" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-delay="1000" data-bs-animation="true" style="background-color: #3b2621; color: #fff; border: solid 2px #3b2621; border-radius: 10px; padding: 10px;">
                          <i class="bi bi-clipboard"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  function copyToClipboard(text) {
    var input = document.createElement('input');
    input.setAttribute('value', text);
    document.body.appendChild(input);
    input.select();
    var result = document.execCommand('copy');
    document.body.removeChild(input);

    if (result) {
      alert('Voucher code copied to clipboard');
    } else {
      alert('Failed to copy voucher code');
    }
  }
</script>

@endsection
