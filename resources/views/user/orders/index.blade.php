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
          <x-profile />
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
                  <a class="nav-link rounded-pill border-2" style="background-color: #3b2621; color: #fff7e8"
                    href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
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
              <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($orders as $order)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                      {{-- 5 Charachter with xxx--}}
                      {{ substr($order->order_id, 0, 5) . 'xxxx' }}
                    </td>
                    <td>
                      @if ($order->type == 'bean')
                      Bean
                      @elseif ($order->type == 'machine')
                      Machine
                      @else
                      Drink
                      @endif
                    </td>
                    <td>{{ $order->quantity }}</td>
                    <td>
                      @if ($order->orderStatus == 'pending')
                      <span class="badge bg-warning text-dark">{{ $order->orderStatus }}</span>
                      @elseif ($order->orderStatus == 'success')
                      <span class="badge bg-success">{{ $order->orderStatus }}</span>
                      @else
                      <span class="badge bg-danger">{{ $order->orderStatus }}</span>
                      @endif
                    </td>
                    <td>Rp. {{ number_format($order->total) }}</td>
                    <td>
                      {{-- Status --}}
                      @if ($order->type == 'bean' || $order->type == 'machine')
                      <a class="btn btn-sm" style="background-color: #5b2ba8; color: #ffffff;"
                        href="{{ route('user.orders.status', $order->id) }}">Status</a>
                      @endif

                      {{-- Detail --}}
                      <a class="btn btn-sm" style="background-color: #3b2621; color: #fff;"
                        href="{{ route('orders.show', $order->id) }}">Detail</a>
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