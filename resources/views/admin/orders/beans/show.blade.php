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
              <td>Product Type</td>
              <td>:</td>
              <td>{{ $order->type }}</td>
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
              <td>Status</td>
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
              <td>Total Bayar</td>
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
                  @foreach ($beans as $coffee)
                  @if($coffee->id == $item->product_id)
                  <img src="{{ asset('storage/img/products/beans/' . $coffee->image) }}" alt="{{ $coffee->name }}"
                    class="img-fluid rounded" style="width: 70px;">
                  @endif
                  @endforeach
                </td>
                <td>
                  @foreach($beans as $coffee)
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

      {{-- Payment Status --}}
      <div class="row">
        <div class="col-6">
          <h5 class="my-3">Payment Status</h5>
          <table class="table table-bordered">
            <tr>
              <td>Payment Method</td>
              <td>:</td>
              <td>{{ $order->paymentMethod }}</td>
            </tr>
            <tr>
              <td>Payment Status</td>
              <td>:</td>
              <td>
                @if($order->paymentStatus == 'pending')
                <span class="badge bg-primary">
                  Pending
                </span>
                @elseif($order->paymentStatus == 'completed')
                <span class="badge bg-success">
                  Completed
                </span>
                @else
                <span class="badge bg-danger">{{ $order->paymentStatus }}</span>
                @endif
              </td>
            </tr>
            <tr>
              <td>Bukti Pembayaran</td>
              <td>:</td>
              <td>
                @if ( $order->paymentMethod == 'transfer' )
                <a href="{{ asset('storage/payments/' . $order->paymentReference) }}" target="_blank"
                  class="text-decoration-none badge bg-danger">
                  <i class="bi bi-eye"></i> View
                </a>
                @else
                <span class="badge bg-danger">
                  User Paid in Cash (COD)
                </span>
                @endif
              </td>
            </tr>
          </table>
        </div>
        <div class="col-6">
          <h5 class="my-3">Shipping Status</h5>
          {{-- Ubah orderStatus --}}
          <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-group mb-3">
              <select name="orderStatus" class="form-select" id="inputGroupSelect01">
                <option value="pending" @if($order->orderStatus == 'pending') selected @endif>Pending</option>
                <option value="processing" @if($order->orderStatus == 'processing') selected @endif>Processing</option>
                <option value="completed" @if($order->orderStatus == 'completed') selected @endif>Completed</option>
                <option value="canceled" @if($order->orderStatus == 'cancelled') selected @endif>Cancelled</option>
              </select>
              <button type="submit" class="btn btn-primary-theme">Update</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection