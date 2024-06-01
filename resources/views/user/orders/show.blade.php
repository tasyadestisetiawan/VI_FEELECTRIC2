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

                {{-- Phone --}}
                <tr>
                  <td>Phone</td>
                  <td>:</td>
                  <td>{{ $order->phone }}</td>
                </tr>

                {{-- Orders Quiantity --}}
                <tr>
                  <td>Quantity</td>
                  <td>:</td>
                  <td>
                    {{ $order->quantity }} items
                  </td>
                </tr>

                {{-- Order Status --}}
                <tr>
                  <td>Order Status</td>
                  <td>:</td>
                  <td>
                    @if ($order->orderStatus == 'pending')
                    @if ($order->paymentStatus == 'pending')
                    <span class="badge bg-danger">
                      You haven't paid yet
                    </span>
                    @else
                    <span class="badge bg-dark">
                      Wait for Admin Confirmation
                    </span>
                    @endif
                    @elseif ($order->orderStatus == 'processing')
                    <span class="badge bg-warning">
                      PROCESSING
                    </span>
                    @elseif ($order->orderStatus == 'completed')
                    <span class="badge bg-success">
                      COMPLETED
                    </span>
                    @elseif ($order->orderStatus == 'cancelled')
                    <span class="badge bg-danger">
                      CANCELLED
                    </span>
                    @endif
                  </td>
                </tr>

                {{-- Payment Status --}}
                <tr>
                  <td>Payment Status</td>
                  <td>:</td>
                  <td>
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
                  </td>
                </tr>

                {{-- Payment Method --}}
                <tr>
                  <td>Payment Method</td>
                  <td>:</td>
                  <td>{{ $order->paymentMethod }}</td>
                </tr>

                {{-- Cost --}}
                @if ($order->paymentMethod == 'transfer' && $order->type == 'bean' || $order->type == 'machine')
                <tr>
                  <td>Cost</td>
                  <td>:</td>
                  <td>
                    Rp. {{ number_format($order->cost) }}
                  </td>
                </tr>
                @else
                <tr>
                  <td>Voucher</td>
                  <td>:</td>
                  <td>
                    {{ $order->voucherDiscount }} % ({{ $order->voucherCode }})
                  </td>
                </tr>
                @endif
              </table>

              {{-- Payment Proof --}}
              @if ($order->type == 'bean' || $order->type == 'machine')
              @if ($order->paymentMethod == 'transfer' && $order->orderStatus == 'unpaid' || $order->paymentStatus ==
              'pending')
              <div class="card p-3 rounded-4 mb-1">
                <h4>Payment</h4>
                <div class="row">

                  {{-- ALert --}}
                  <div class="alert alert-warning rounded-4" role="alert">
                    Please transfer to the following account number:
                    <br>
                    <strong>
                      Bank BCA {{ $payment }} A/N Feelectric
                    </strong>
                  </div>

                  <div class="col-12">
                    <form action="{{ route('user.orders.upload-payment.store', $order->id) }}" method="POST"
                      enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label for="payment" class="form-label">Upload Payment Proof</label>
                        <input class="form-control" type="file" id="payment" name="paymentProof">
                      </div>
                      <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    </form>
                  </div>
                </div>
              </div>
              @endif
              @endif

              @if ($order->type == 'drink' && $order->paymentMethod == 'wallet')
              <form id="pay" onsubmit="return submitForm();" class="my-3">
                @csrf @method('PUT') <input type="hidden" id="amount" name="amount" value="{{ $order->total }}">
                <button type="submit" class="btn" style="background-color: #3b2621; color: white;">Pay Now</button>
              </form>
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

                        {{-- Beans --}}
                        @if ($order->type == 'bean')
                        @foreach ($beans as $bean)
                        @if ($bean->id == $item->product_id)
                        {{ $bean->name }}
                        @endif
                        @endforeach
                        @endif

                        {{-- Machines --}}
                        @if ($order->type == 'machine')
                        @foreach ($machines as $machine)
                        @if ($machine->id == $item->product_id)
                        {{ $machine->name }}
                        @endif
                        @endforeach
                        @endif

                        {{-- Drinks --}}
                        @if ($order->type == 'drink')
                        @foreach ($coffees as $coffee)
                        @if ($coffee->id == $item->product_id)
                        {{ $coffee->name }}
                        @endif
                        @endforeach
                        @endif

                      </td>
                      <td>
                        {{-- Bean --}}
                        @if ($order->type == 'bean')
                        @foreach ($beans as $bean)
                        @if ($bean->id == $item->product_id)
                        {{ $bean->weight }}
                        @endif
                        @endforeach
                        @endif

                        {{-- Machine --}}
                        @if ($order->type == 'machine')
                        @foreach ($machines as $machine)
                        @if ($machine->id == $item->product_id)
                        {{ $machine->weight }}
                        @endif
                        @endforeach
                        @endif

                        {{-- Drink --}}
                        @if ($order->type == 'drink')
                        @foreach ($coffees as $coffee)
                        @if ($coffee->id == $item->product_id)
                        {{ $coffee->variant }}
                        @endif
                        @endforeach
                        @endif
                      </td>
                      <td>Rp. {{ number_format($item->price) }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td>
                        {{-- Price * Quantity - VoucherDiscount --}}
                        Rp. {{ number_format($item->price * $item->quantity )}} - Rp. {{ number_format($item->price *
                        $item->quantity * $order->voucherDiscount / 100) }} ({{ $order->voucherDiscount }}%)
                      </td>
                    </tr>
                    @endforeach

                    {{-- Sub Total --}}
                    <tr class="fw-bold bg-secondary" style="border-top: 3px solid black !important;">
                      <td colspan="4">Cost</td>
                      <td>Rp. {{ number_format($order->cost) }}</td>
                    </tr>

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
  </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

<script>
  // Pay with Midtrans
  function submitForm() {
    snap.pay('{{ $order->snap_token }}', {
      onSuccess: function(result) {
        console.log('success');
        console.log(result);
        location.href = '{{ route('orders.index') }}';
      },
      onPending: function(result) {
        console.log('pending');
        console.log(result);
        location.href = '{{ route('orders.index') }}';
      },
      onError: function(result) {
        console.log('error');
        console.log(result);
        location.href = '{{ route('orders.index') }}';
      }
    });
    return false;
  }

</script>

@endsection