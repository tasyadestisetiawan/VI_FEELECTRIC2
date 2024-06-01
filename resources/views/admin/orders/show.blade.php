@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <!-- Back -->
    <a href="{{ url('admin/orders') }}" class="btn btn-sm btn-primary-theme float-end">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <a href="" class="btn btn-sm btn-delete-theme float-end me-1">
      <i class="bi bi-printer"></i> Print
    </a>
  </div>
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">

      <!-- Alert -->
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <!-- Personal Information -->
      <div class="row">
        <div class="col-md-6">
          <h5>Personal Information</h5>
          <table class="table table-borderless">
            <tr>
              <td>Name</td>
              <td>:</td>
              <td>{{ $order->name }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td>{{ $order->email }}</td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td>{{ $order->phone }}</td>
            </tr>
            <tr>
              <td>Address</td>
              <td>:</td>
              <td>{{ $order->address }}</td>
            </tr>
          </table>
        </div>
        <div class="col-md-6">
          <h5>Order Information</h5>
          <table class="table table-borderless">
            <tr>
              <td>Order ID</td>
              <td>:</td>
              <td>{{ $order->order_id }}</td>
            </tr>
            <tr>
              <td>Date</td>
              <td>:</td>
              <td>
                {{ $order->created_at->format('d M Y') }} at {{ $order->created_at->format('H:i') }}
              </td>
            </tr>
            <tr>
              <td>Order Status</td>
              <td>:</td>
              <td>
                @if($order->orderStatus == 'pending')
                <span class="badge bg-primary">
                  Pending
                </span>
                @elseif($order->orderStatus == 'completed')
                <span class="badge bg-success">
                  Completed
                </span>
                @else
                <span class="badge bg-danger">{{ $order->orderStatus }}</span>
                @endif
              </td>
            </tr>
            <tr>
              <td>
                Payment Method
              </td>
              <td>:</td>
              <td>
                {{-- paymentMethod --}}
                @if($order->paymentMethod == 'cash')
                <span class="badge bg-primary">
                  Cash
                </span>
                @elseif($order->paymentMethod == 'wallet')
                <span class="badge bg-success">
                  Wallet
                </span>
                @else
                <span class="badge bg-danger">{{ $order->paymentMethod }}</span>
                @endif
              </td>
            </tr>
            <tr>
              <td>Amount</td>
              <td>:</td>
              <td>
                Rp {{ number_format($order->total, 0, ',', '.') }}
              </td>
            </tr>
          </table>
        </div>
      </div>

      <!-- Order Items -->
      <div class="row">
        <div class="col-md-12">
          <h5>Order Items</h5>
          <table class="table table-bordered mt-2">
            <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Size</th>
                <th>Variant</th>
                <th>Quantity</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->products as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  @foreach ($coffees as $coffee)
                  @if($coffee->id == $item->product_id)
                  @if ($coffee->variant == 'hot')
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" alt="{{ $coffee->name }}"
                    class="img-fluid rounded" style="width: 70px;">
                  @elseif ($coffee->variant == 'ice')
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}" alt="{{ $coffee->name }}"
                    class="img-fluid rounded" style="width: 70px;">
                  @else
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" alt="{{ $coffee->name }}"
                    class="img-fluid rounded" style="width: 70px;">
                  @endif
                  @endif
                  @endforeach
                </td>
                <td>
                  @foreach($coffees as $coffee)
                  @if($coffee->id == $item->product_id)
                  {{ $coffee->name }}
                  @endif
                  @endforeach
                </td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->temperature }}</td>
                <td>{{ $item->quantity }}</td>
                <td>
                  Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection