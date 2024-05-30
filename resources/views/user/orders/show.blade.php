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
          <div class="card rounded-4 shadow" style="border: solid 1px #3b2621;">
            <div class=" card-header border-0 mt-2">
              <div class="card border-0" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-3">
                    <img
                      src="https://i0.wp.com/www.cssscript.com/wp-content/uploads/2020/12/Customizable-SVG-Avatar-Generator-In-JavaScript-Avataaars.js.png?fit=438%2C408&ssl=1"
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
                      <img
                        src="https://static.vecteezy.com/system/resources/previews/028/766/371/original/gopay-payment-icon-symbol-free-png.png"
                        alt="Gopay" class="img-fluid pe-3" style="width: 80px;"></i> <span class="ms-2">Gopay</span>
                      <p class="btn btn-success ms-auto mb-0">Aktifkan</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Member Card -->
              <div class="row mt-2">
                <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
                  <div class="card-body">
                    <div class="member-card d-flex align-items-center py-2">
                      <i class="bi bi-credit-card-2-front-fill" style="font-size: 40px;"></i> <span class="ms-2">Member
                        Card</span>
                      <p class="btn btn-success ms-auto mb-0">Aktifkan</p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Saldo -->
              <div class="row mt-2">
                <div class="card rounded-4 border-0 shadow-sm" style="background-color: #f0f9ff;">
                  <div class="card-body">
                    <div class="saldo d-flex align-items-center py-2">
                      <i class="bi bi-currency-dollar" style="font-size: 40px;"></i> <span class="ms-2">Saldo</span>

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
          <div class="card rounded-4 shadow w-100" style="border: solid 1px #3b2621;">
            <div class="card-header border-0 mt-4 ms-2">
              <h5 class="fw-bold">Detail Order</h5>
            </div>
            <div class="card-body mx-2">
              <table class="table">
                <!-- Name -->
                <tr>
                  <td>Name</td>
                  <td>:</td>
                  <td>{{ $order->name }}</td>
                </tr>
                <!-- Address -->
                <tr>
                  <td>Address</td>
                  <td>:</td>
                  <td>{{ $order->address }}</td>
                </tr>
                <!-- Phone -->
                <tr>
                  <td>Phone</td>
                  <td>:</td>
                  <td>{{ $order->phone }}</td>
                </tr>
                <!-- paymentMethod -->
                <tr>
                  <td>Payment Method</td>
                  <td>:</td>
                  <td>{{ $order->paymentMethod }}</td>
                </tr>
              </table>

              @if ($order->type == 'bean' || $order->type == 'machine')
              @if ($order->paymentMethod == 'transfer' && $order->status == 'unpaid')
              <div class="card p-3 rounded-4 mb-1">
                <h4>Payment</h4>
                <div class="row">
                  <div class="col-12">
                    {{-- Upload Bukti Pembayaran --}}
                    <form action="{{ route('user.orders.upload-payment.store', $order->id) }}" method="POST"
                      enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label for="payment" class="form-label">Upload Payment</label>
                        <input class="form-control" type="file" id="payment" name="paymentProof">
                      </div>
                      <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </form>
                  </div>
                </div>
              </div>
              @endif
              @endif

              <!-- List Products Order -->
              <div class="card p-3 rounded-4">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Variant</th>
                      <th>Price</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->products as $item)
                    <tr>
                      <td>
                        @foreach ($coffees as $coffee)
                        @if ($coffee->id == $item->id)
                        {{ $coffee->name }}
                        @endif
                        @endforeach
                      </td>
                      <td>
                        @if ($item->temperature == 'hot')
                        Hot
                        @elseif ($item->temperature == 'ice')
                        Ice
                        @endif
                      </td>
                      <td>Rp. {{ number_format($item->price) }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td>Rp. {{ number_format($item->price * $item->quantity) }}</td>
                    </tr>
                    @endforeach
                    <!-- Total -->
                    <tr class="fw-bold bg-secondary">
                      <td>Total</td>
                      <td colspan="3"></td>
                      <td>Rp. {{ number_format($order->total) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>

    @endsection