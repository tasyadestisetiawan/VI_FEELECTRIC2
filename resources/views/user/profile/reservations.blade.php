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
                    <img src="{{ asset('storage/img/avatars/' . Auth::user()->avatar) }}"
                      class="img-fluid rounded-start" alt="...">
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
                      <img src="{{ asset('frontend/img/icons/gopay.png') }}" alt="Gopay" class="img-fluid pe-3"
                        style="width: 50px;"></i> <span class="ms-2">Gopay</span>
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
                      <img src="{{ asset('frontend/img/icons/payment.png') }}" alt="Gopay" class="img-fluid pe-3"
                        style="width: 50px;"></i> <span class="ms-2">Member Card</span>
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
                      <img src="{{ asset('frontend/img/icons/saldo.png') }}" alt="Gopay" class="img-fluid pe-3"
                        style="width: 50px;"></i> <span class="ms-2">Saldo</span>

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
                  <a class="nav-link active rounded-pill" style="background-color: #fff7e8;  color: #3b2621;"
                    href="{{route('user.profile')}}">
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #3b2621; color: #fff"
                    href="{{ route('user.reservations.my') }}">
                    Reservations
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('user.address')}}">Address</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('vouchers.index')}}">Vouchers</a>
                </li>
              </ul>
            </div>
            <div class="card-body mx-2">

              <!-- Table -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Room</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($reservations as $reservation)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                      {{-- Room --}}
                      @foreach ( $rooms as $room )
                      @if ($room->id == $reservation->room_id)
                      <a href="{{ route('rooms.show', $room->id) }}">
                        {{ $room->name }}
                      </a>
                      @endif
                      @endforeach
                    </td>
                    <td>
                      {{-- Date --}}
                      {{ $reservation->check_in }}
                    </td>
                    <td>Rp. {{ number_format($reservation->amount) }}</td>
                    <td>
                      {{-- Status --}}
                      @if ($reservation->status == 'pending')
                      <span class="badge bg-warning text-dark">{{ $reservation->status }}</span>
                      @elseif ($reservation->status == 'approved')
                      <span class="badge bg-success">{{ $reservation->status }}</span>
                      @else
                      <span class="badge bg-danger">{{ $reservation->status }}</span>
                      @endif
                    </td>
                    <td>
                      {{-- Detail --}}
                      <a class="btn btn-sm" style="background-color: #3b2621; color: #fff;"
                        href="{{ route('reservations.show', $reservation->id) }}">Detail</a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">
                      <img src="{{ asset('frontend/img/notfound.png') }}" alt="Empty" class="img-fluid"
                        style="width: 100px;">
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