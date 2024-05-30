@extends('layouts.home')

<style>
  .input-group-text {
    border: 2px solid #3b2621 !important;
    background-color: #f8f9fa !important;
    border-right: none !important;
  }

  .form-control {
    border: 2px solid #3b2621 !important;
    border-left: none !important;
  }

  .nav-link {
    color: #3b2621 !important;
    border: 2px solid #3b2621 !important;
  }

  .active {
    background-color: #3b2621 !important;
    color: white !important;
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="header">
    <h1 class="text-start">Rooms</h1>
    <p class="description">
      Find and book your favorite room here.
    </p>
  </div>
  <div class="content">
    <div class="row">
      @foreach($rooms as $room)
      <div class="col-md-4">
        <div class="card rounded-3 shadow" style="border: solid 2px #3b2621;">
          <div class="m-3">
            <img src="{{ asset('storage/img/rooms/' . $room->photo) }}" class="card-img-top rounded object-fit cover"
              alt="..." style="height: 200px;">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ $room->name }}</h5>
            <p class="card-text">{{ $room->description }}</p>
            <div class="row mb-3">
              <div class="col-6">
                <span>
                  {{-- Capacity --}}
                  <i class="bi bi-people-fill fw-bold"></i>
                  {{ $room->capacity }} People
                </span>
              </div>
              <div class="col-6">
                <span>
                  {{-- Status --}}
                  <span class="fw-bold">
                    @if($room->status == 'available')
                    <i class="bi bi-check-circle-fill fw-bold"></i>
                    Available
                    @else
                    <i class="bi bi-x-circle-fill fw-bold"></i>
                    Unvailable
                    @endif
                  </span>
                </span>
                </span>
              </div>
            </div>
            <div class="row mb-3">
              {{-- Price --}}
              <div class="col-12">
                <span class="fw-bold fs-4">
                  {{-- Rupiah --}}
                  @if($room->price == 0)
                  Free
                  @else
                  Rp {{ number_format($room->price, 0, ',', '.') }} <sub>
                    / Hour
                  </sub>
                  @endif
                </span>
              </div>
            </div>
            <div class="row mx-0">
              @if ($room->status == 'available')
              <a href="{{ route('rooms.show', $room->id) }}" class="btn"
                style="background-color: #3b2621; color: white;">
                Reserve Now
              </a>
              @else
              <a href="#" class="btn" style="background-color: #2e1f1b80; color: white;" disabled>
                Unavailable For Booking
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection