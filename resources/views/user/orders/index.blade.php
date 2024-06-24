@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <div class="row">

        <div class="col-md-5 col-12 mb-4">
          <x-profile />
        </div>

        <div class="col-md-7 col-12">
          <div class="card rounded-4 shadow-sm w-100" style="border: solid 3px #3b2621;">
            <div class="card-header bg-white border-0 mt-2">
              <ul class="nav nav-pills gap-3 flex-column flex-md-row">
                <li class="nav-item">
                  <a class="nav-link active rounded-pill mb-2 mb-md-0" style="background-color: #fff7e8;  color: #3b2621;" href="{{route('user.profile')}}">
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill mb-2 mb-md-0 border-2" style="background-color: #3b2621; color: #fff7e8" href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill mb-2 mb-md-0 border-2" style="background-color: #fff7e8; color: #3b2621" href="{{ route('user.reservations.my') }}">
                    Reservations
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill mb-2 mb-md-0 border-2" style="background-color: #fff7e8; color: #3b2621" href="{{route('user.address')}}">Address</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill mb-2 mb-md-0 border-2" style="background-color: #fff7e8; color: #3b2621" href="{{route('vouchers.index')}}">Vouchers</a>
                </li>
              </ul>
            </div>
            <div class="card-body mx-2">
             <!-- Table -->
             <div class="table-responsive">
               <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th scope="col">Invoice</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($orders as $order)
                  <tr>
                    <td class="text-uppercase">
                      {{ $order->order_id }}
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
                      <span class="badge bg-warning text-dark">
                        PENDING
                      </span>
                      @elseif ($order->orderStatus == 'processing')
                      <span class="badge bg-success">
                        PROCESSING
                      </span>
                      @elseif ($order->orderStatus == 'completed')
                      <span class="badge bg-primary">
                        COMPLETED
                      </span>
                      @else
                      <span class="badge bg-danger">
                        CANCELLED
                      </span>
                      @endif
                    </td>
                    <td>
                      <!-- Payment Status -->
                      @if ($order->paymentMethod == 'cash')
                      <span class="badge bg-success">
                        PAY AT <br>
                        CASHIER
                      </span>
                      @else
                      @if ($order->paymentStatus == 'pending')
                      <span class="badge bg-warning text-dark">
                        UNPAID
                      </span>
                      @elseif ($order->paymentStatus == 'paid')
                      <span class="badge bg-success">
                        PAID
                      </span>
                      @elseif ($order->paymentStatus == 'rejected')
                      <span class="badge bg-danger">
                        REJECTED
                      </span>
                      @endif
                      @endif
                    </td>
                    <td>
                      <!-- Action Buttons -->
                      <div class="d-flex gap-2">
                        <a class="btn btn-sm" style="background-color: #3b2621; color: #fff; padding: 8px 12px; font-size: 0.875rem;" href="{{ route('orders.show', $order->id) }}" tooltip="tooltip" title="Detail" data-bs-toggle="tooltip" data-bs-placement="top">
                          <i class="bi bi-info-circle-fill" style="font-size: 1rem;"></i>
                        </a>
                        @if ($order->type == 'bean' || $order->type == 'machine')
                        <a class="btn btn-sm" style="background-color: #2f41e7; color: #ffffff; padding: 8px 12px; font-size: 0.875rem;" href="{{ route('user.orders.status', $order->id) }}" tooltip="tooltip" title="Tracking Order" data-bs-toggle="tooltip" data-bs-placement="top">
                          <i class="bi bi-truck" style="font-size: 1rem;"></i>
                        </a>
                        @endif
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">
                      <img src="{{ asset('frontend/img/notfound.png') }}" alt="Empty" class="img-fluid" style="width: 100px;">
                      <p class="text-center">No Orders Found</p>
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
</div>

@endsection
