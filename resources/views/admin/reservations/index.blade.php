@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          {{-- Alert Notifications --}}
          <x-alert type="success" :message="session('success')" />
          <x-alert type="danger" :errors="$errors->all()" />

          <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Room</th>
                  <th>Check In</th>
                  <th>Check Out</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    @foreach ($rooms as $room )
                    @if ($reservation->room_id == $room->id)
                    <a href="{{ route('admin.rooms.show', $room->id) }}">{{ $room->name }}</a>
                    @endif
                    @endforeach
                  </td>
                  <td>
                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }} at {{
                    \Carbon\Carbon::parse($reservation->check_in_time)->format('h:i A') }}
                  </td>
                  <td>
                    {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }} at {{
                    \Carbon\Carbon::parse($reservation->check_out_time)->format('h:i A') }}
                  </td>
                  <td>
                    @if ($reservation->status == 'pending')
                    <span class="badge bg-warning">
                      PENDING
                    </span>
                    @elseif ($reservation->status == 'approved')
                    <span class="badge bg-success">
                      APPROVED
                    </span>
                    @else
                    <span class="badge bg-danger">
                      CANCELLED
                    </span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.reservations.show', $reservation->id) }}"
                      class="btn btn-sm btn-detail-theme">
                      <i class="bi bi-info-circle"></i>
                    </a>
                    <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST"
                      class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-delete-theme"
                        onclick="return confirm('Are you sure you want to delete this reservation?')">
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
  </div>
</div>
@endsection