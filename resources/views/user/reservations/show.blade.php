@extends('layouts.home')

<style>
  input {
    border: 2px solid #3b2621 !important;
  }

  .card {
    border: solid 2px #3b2621 !important;
  }

  .btn-upload {
    background-color: #3b2621 !important;
    color: white !important;
    border: none;
    border-radius: 10px;
  }
</style>

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
          <div class="card rounded-4 shadow w-100" style="border: solid 1px #3b2621;">
            <div class="card-header border-0 mt-4 ms-2">
              <h5 class="fw-bold">Detail Booking</h5>
            </div>
            <div class="card-body mx-2">

              {{-- Booking Information --}}
              <table class="table">
                <tr>
                  <td class="fw-bold">Room</td>
                  <td>
                    @foreach ( $rooms as $room )
                    @if ( $room->id == $reservation->room_id )
                    <a href="{{ route('rooms.show', $room->id) }}" class="text-primary">{{ $room->name }}</a>
                    @endif
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <td class="fw-bold">
                    Check-in
                  </td>
                  <td>
                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('d F Y') }} at {{
                    \Carbon\Carbon::parse($reservation->check_in_time)->format('h:i A') }}
                  </td>
                </tr>
                <tr>
                  <td class="fw-bold">
                    Check-out
                  </td>
                  <td>
                    {{ \Carbon\Carbon::parse($reservation->check_in)->format('d F Y') }} at {{
                    \Carbon\Carbon::parse($reservation->check_out_time)->format('h:i A') }}
                  </td>
                </tr>
                <tr>
                  <td class="fw-bold">Booking Status</td>
                  <td>
                    @if ($reservation->status == 'pending')
                    <span class="badge bg-warning text-dark">{{ $reservation->status }}</span>
                    @elseif ($reservation->status == 'approved')
                    <span class="badge bg-success">{{ $reservation->status }}</span>
                    @elseif ($reservation->status == 'rejected')
                    <span class="badge bg-danger">{{ $reservation->status }}</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <td class="fw-bold">Total Price</td>
                  <td>Rp. {{ number_format($reservation->amount) }}</td>
                </tr>
              </table>

              {{-- Payment Upload --}}
              @if ($reservation->status == 'pending' && $reservation->payment_method == 'transfer')
              {{-- Upload Form --}}
              <form action="{{ route('reservations.update', $reservation->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="payment_proof" class="form-label fw-bold">Upload Payment Proof</label>
                  <input class="form-control" type="file" id="payment_proof" name="payment_proof">
                </div>
                <button type="submit" class="btn btn-sm btn-upload">Upload</button>
              </form>
              @else
              <span>
                You using cash payment method, no need to upload payment proof. But, please pay the amount to our staff
                when you check-in.
              </span>
              @endif

            </div>
          </div>

        </div>
      </div>
    </div>

    @endsection