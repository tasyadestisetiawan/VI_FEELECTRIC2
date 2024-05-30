@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      {{-- Back Button Float End --}}
      <a href="{{ route('admin.reservations.index') }}" class="btn btn-dark btn-sm float-end">Back</a>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          {{-- Alert Notifications --}}
          <x-alert type="success" :message="session('success')" />
          <x-alert type="danger" :errors="$errors->all()" />

          <div class="row">
            <div class="col-md-6">
              <h4>Reservation Details</h4>
              <table class="table table-bordered mt-3">
                <tr>
                  <td>Room</td>
                  <td>
                    @foreach ($rooms as $room )
                    @if ($reservation->room_id == $room->id)
                    <a href="{{ route('admin.rooms.show', $room->id) }}">{{ $room->name }}</a>
                    @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td>Check In</td>
                  <td>
                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }} at {{
                    \Carbon\Carbon::parse($reservation->check_in)->format('h:i A') }}
                  </td>
                </tr>
                <tr>
                  <td>Check Out</td>
                  <td>
                    {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }} at {{
                    \Carbon\Carbon::parse($reservation->check_out)->format('h:i A') }}
                  </td>
                </tr>
                <tr>
                  <td>Guests</td>
                  <td>{{ $reservation->total_guests }} Person</td>
                </tr>
                <tr>
                  <td>Status</td>
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
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <h4>Guest Details</h4>
              <table class="table table-bordered mt-3">
                <tr>
                  <td>Name</td>
                  <td>
                    @foreach ($users as $user )
                    @if ($reservation->user_id == $user->id)
                    {{ $user->name }}
                    @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>
                    @foreach ($users as $user )
                    @if ($reservation->user_id == $user->id)
                    {{ $user->email }}
                    @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td>Phone</td>
                  <td>
                    @foreach ($users as $user )
                    @if ($reservation->user_id == $user->id)
                    {{ $user->phone }}
                    @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td>Special Request</td>
                  <td>
                    @if ($reservation->special_request)
                    {{ $reservation->special_request }}
                    @else
                    <span class="text-muted fw-light">No special request</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Payment</td>
                  <td>
                    @if ($reservation->payment_status == 'paid')
                    <span class="badge bg-success">PAID</span>
                    @else
                    <span class="badge bg-danger">UNPAID</span>
                    @endif
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mt-3">
              <h4>Payment Details</h4>
              <table class="table table-bordered mt-3">
                <tr>
                  <td>Amount</td>
                  <td>
                    Rp {{ number_format($reservation->amount, 0, ',', '.') }} <br>
                    <small class="text-muted">
                      *The total price that must be paid by the guest
                    </small>
                  </td>
                </tr>
                <tr>
                  <td>Payment Proof</td>
                  <td>
                    @if ($reservation->payment_proof)
                    <a href="{{ asset('storage/img/reservations/' . $reservation->payment_proof) }}" target="_blank">
                      View Image
                    </a>
                    @else
                    <span class="text-muted fw-light">No payment proof</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Change Status Booking</td>
                  <td>
                    <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="input-group">
                        <select name="status" class="form-select" style="width: 200px !important;">
                          <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending
                          </option>
                          <option value="approved" {{ $reservation->status == 'approved' ? 'selected' : '' }}>Approved
                          </option>
                          <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : ''
                            }}>Cancelled</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </form>
                </tr>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection