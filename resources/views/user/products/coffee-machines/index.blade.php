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
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="d-flex justify-content-between">
    <div class="input-group w-auto rounded-pill">
      <span class="input-group-text" style="background-color: white">
        <a href="#">
          <i class="bi bi-search" style="color: #3b2621"></i>
        </a>
      </span>
      <input type="text" class="form-control" placeholder="Mau minum apa hari ini..." aria-label="Search" />
    </div>
    <ul class="nav nav-pills gap-3">
      <li class="nav-item">
        <a class="nav-link active rounded-pill" style="background-color: #3b2621" href="#">All's</a>
      </li>
    </ul>
  </div>

  {{-- Menu Items --}}
  <div class="container mt-5">

    {{-- Coffees Machines --}}
    <div class="coffes-drink">
      <div class="d-flex justify-content-between mb-4">
        <h2 class="float-start">
          Coffee Machines
        </h2>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach ($coffeeMachines as $coffee)
        <div class="col-4">
          <div class="card rounded-3 p-3 shadow-sm product-card h-100"
            style="color: #3b2621 !important; border: 2px solid #3b2621;">
            <a href="#">
              <img src="{{ asset('storage/img/products/machines/' . $coffee->image) }}"
                class="card-img-top object-fit cover" alt="..." height="250px" />
            </a>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">
                {{ $coffee->name }}
              </h5>
              <p class="card-text flex-grow-1">
                {{ Str::limit($coffee->description, 50) }}
              </p>
            </div>
            <div class="card-footer bg-white border-top-0 pb-3">
              <div class="d-flex justify-content-between">
                <span class="fw-bold pt-2">
                  Rp {{ number_format($coffee->price, 0, ',', '.') }}
                </span>
                @if ($coffee->stock == 0)
                <button type="disable" class="btn text-light rounded" style="background-color: #3b262185; color: white">
                  Out of Stock
                </button>
                @else
                <a href="{{ route('coffee-machines.show', $coffee->id) }}" class="btn text-light rounded"
                  style="background-color: #3b2621; color: white">
                  Buy
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
  {{-- End of Menu Items --}}

</div>
@endsection