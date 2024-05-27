@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <a href="" class="btn btn-primary-theme float-end">
      <i class="bi bi-printer"></i> Print
    </a>
  </div>
  <div class="card shadow mb-4 mt-3">
    <div class="card-body">

      <!-- Alert -->
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <!-- Table Orders -->
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer Name</th>
              <th>Date</th>
              <th>Status</th>
              <th>Total Bayar</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>{{ $order->order_id }}</td>
              <td>{{ $order->name }}</td>
              <td>
                {{ $order->created_at->format('d M Y') }} at {{ $order->created_at->format('H:i') }}
              </td>
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
              <td>
                Rp {{ number_format($order->total, 0, ',', '.') }}
              </td>
              <td>

                <!-- Completed Confirmation -->
                @if($order->orderStatus == 'pending')
                <form action="{{ url('admin/orders', $order->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="orderStatus" value="completed">
                  <button type="submit" class="btn btn-sm btn-detail-theme" onclick="return confirm('Are you sure?')">
                    <i class="bi bi-check fw-bold"></i> Done
                  </button>
                </form>
                @endif

                <!-- Detail -->
                <a href="{{ url('admin/orders', $order->id) }}" class="btn btn-sm btn-primary-theme">
                  <i class="bi bi-info-circle"></i>
                </a>

                <!-- Delete -->
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-delete-theme" onclick="return confirm('Are you sure?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection