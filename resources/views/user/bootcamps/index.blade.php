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
    <h1 class="text-start">Bootcamps</h1>
    <p class="description">
      Barista Bootcamp is a course that will teach you everything you need to know to become a professional barista.
    </p>
  </div>
  <div class="content mb-5 pb-5">
    <div class="row">
      @forelse($bootcamps as $bootcamp)
      <div class="col-md-4">
        <div class="card rounded-3 shadow" style="border: solid 2px #3b2621;">
          <div class="m-3">
            <img src="{{ asset('storage/img/bootcamps/poster/' . $bootcamp->image) }}" class="card-img-top" alt="...">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ $bootcamp->name }}</h5>
            <p class="card-text">{{ $bootcamp->description }}</p>
            <div class="row mb-3">
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-calendar"></i>
                  {{ $bootcamp->start_date }}
                </span>
              </div>
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-clock"></i>
                  {{ \Carbon\Carbon::parse($bootcamp->start_time)->format('H:i') }} - {{
                  \Carbon\Carbon::parse($bootcamp->end_time)->format('H:i') }}
                </span>
              </div>
            </div>
            <div class="row mb-3">
              {{-- Price --}}
              <div class="col-6">
                <span class="fw-bold fs-4">
                  {{-- Rupiah --}}
                  @if($bootcamp->price == 0)
                  Free
                  @else
                  Rp {{ number_format($bootcamp->price, 0, ',', '.') }}
                  @endif
                </span>
              </div>
            </div>
            <div class="row mx-1">
              <a href="{{ route('bootcamps.show', $bootcamp->id) }}" class="btn"
                style="background-color: #3b2621; color: white;">
                Register Now
              </a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col">
        <div class="alert" role="alert" style="border: solid 3px #3b2621 !important;">
          There are no bootcamps available.
        </div>
      </div>
      @endforelse
    </div>
  </div>
</div>

@endsection