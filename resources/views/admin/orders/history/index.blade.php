@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
<div class="header clearfix">
  <form action="{{ route('admin.orders.print') }}" method="GET" class="form-inline float-end">
    <div class="row gx-3 align-items-center">
      <div class="col-auto">
        <label for="date" class="sr-only">Date</label>
        <input type="date" class="form-control" id="date" name="date" placeholder="Select Date">
      </div>
      <div class="col-auto">
        <label for="month" class="sr-only">Month</label>
        <input type="month" class="form-control" id="month" name="month" placeholder="Select Month">
      </div>
      <div class="col-auto">
        <label for="year" class="sr-only">Year</label>
        <input type="number" class="form-control" id="year" name="year" placeholder="Select Year">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary-theme mb-2">
          <i class="bi bi-printer"></i> Print
        </button>
      </div>
    </div>
  </form>
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
                <!-- Detail -->
                <a href="{{ url('admin/orders-history', $order->id) }}" class="btn btn-sm btn-primary-theme">
                  <i class="bi bi-info-circle"></i>
                </a>

                <!-- Delete -->
                <form action="{{ route('admin.orders-history.destroy', $order->id) }}" method="POST" class="d-inline">
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
