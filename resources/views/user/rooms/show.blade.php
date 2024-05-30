@extends('layouts.home')

<style>
  .table-borderless {
    background-color: transparent !important;
  }

  .table-borderless th,
  .table-borderless td {
    background-color: transparent !important;
  }

  .modal-dialog {
    background-color: #fff7e8 !important;
    border-radius: 10px !important;
  }

  input {
    background-color: #f8f9fa !important;
    border: solid 2px #3b2621 !important;
  }

  textarea {
    background-color: #f8f9fa !important;
    border: solid 2px #3b2621 !important;
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-5">

    {{-- Alert Notifications --}}
    <x-alert type="success" :message="session('success')" />
    <x-alert type="danger" :errors="$errors->all()" />

    <h2 class="fw-bolder">
      {{ $room->name }}
    </h2>
    <div class="content mt-3">
      <div class="row">
        <div class="col-6">
          <img src="{{ asset('storage/img/rooms/' . $room->photo) }}" class="img-fluid" alt="...">
        </div>
        <div class="col-6">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td class="fw-bold">
                  <i class="bi bi-people-fill"></i>
                  Capacity
                </td>
                <td>{{ $room->capacity }} People</td>
              </tr>
              <tr>
                <td class="fw-bold">
                  {{-- Status --}}
                  <i class="bi bi-check-circle-fill"></i>
                  Status
                </td>
                <td>
                  @if($room->status == 'available')
                  <span class="text-success fw-bold">Available</span>
                  @else
                  <span class="text-danger fw-bold">Full</span>
                  @endif
                </td>
              </tr>
              <tr>
                <td class="fw-bold">
                  {{-- Facilities --}}
                  <i class="bi bi-wifi"></i>
                  Facilities
                </td>
                <td>
                  {{ $room->facilities }}
                </td>
              </tr>
              <tr>
                <td class="fw-bold">
                  <i class="bi bi-credit-card"></i>
                  Price
                </td>
                <td>Rp. {{ number_format($room->price, 0, ',', '.') }}</td>
              </tr>
              <tr>
                <td>
                  {{-- Description --}}
                  {{ $room->description }}
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row mx-2">
            @auth
            {{-- Button Register --}}
            @if($room->status == 'available')
            {{-- Modal Button --}}
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#registerModal"
              style="background-color: #3b2621; color: white;">
              Booking Now
            </button>
            @else
            <button type="button" class="btn" disabled style="background-color: #3b2621; color: white;">
              Quota has been full, sorry!
            </button>
            @endif
            @else
            <a href="{{ route('login') }}" class="btn" style="background-color: #3b2621; color: white;">
              Login to Book
            </a>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal Register --}}
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('reservations.store', $room->id) }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">
            Booking Room
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          <div class="row">
            <div class="col-6">
              <img src="{{ asset('storage/img/rooms/' . $room->photo) }}" class="img-fluid rounded-3" alt="...">
            </div>
            <div class="col-6">
              <h2>
                {{ $room->name }}
              </h2>
              <p>
                {{ $room->description }}
              </p>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td class="fw-bold">
                      <i class="bi bi-people-fill"></i> {{ $room->capacity }} People
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          {{-- Form --}}
          <div class="row">
            <div class="col-12">
              <div class="mb-3 mt-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
              <div class="row">
                <div class="mb-3 col">
                  {{-- Total Guest --}}
                  <label for="guest" class="form-label">Total Guest</label>
                  <input type="number" class="form-control" id="guest" name="total_guests" required>
                </div>
                <div class="mb-3 col">
                  <label for="date" class="form-label">Date</label>
                  <input type="date" class="form-control" id="date" name="check_in" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-6">
                  <label for="start" class="form-label">Start</label>
                  <input type="time" class="form-control" id="start" name="check_in_time" required>
                </div>
                <div class="col-6">
                  <label for="end" class="form-label">End</label>
                  <input type="time" class="form-control" id="end" name="check_out_time" required>
                </div>
              </div>
              <div class="row mb-1">
                {{-- Special Request --}}
                <div class="col-12">
                  <label for="request" class="form-label">Special Request</label>
                  <textarea class="form-control" id="request" name="special_request" rows="3"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mx-2">
          <small>
            After you click the register button, please send the payment proof in <strong>
              myprofile -> reservations -> detail
            </strong>
          </small>
        </div>
        {{-- room ID --}}
        <input type="hidden" name="room_id" value="{{ $room->id }}">
        <div class="modal-footer">
          <button type="submit" class="btn" style="background-color: #3b2621; color: white;">Book Now</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- <div class="container mt-4 mb-5">
  <h2 class="mb-3">Produk Terkait</h2>
  <div class="row row-cols-1 row-cols-md-3 g-4">
  </div>
</div> --}}

<!-- SweetALert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
  Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

@endsection