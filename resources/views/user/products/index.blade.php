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
        <a class="nav-link rounded-pill border-2" href="#all">Semua</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" href="#drinks">Coffee Drink's</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" href="#beans">
          Coffee Beans
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" href="#machines">
          Coffee Machines
        </a>
      </li>
    </ul>
  </div>

  {{-- Menu Items --}}
  <div class="container mt-5" id="all">

    {{-- Coffees Drink --}}
    <div class="coffes-drink" id="drinks">
      <div class="d-flex justify-content-between mb-4">
        <h2 class="float-start">
          Coffees Drink
        </h2>
        <a href="{{ route('coffees.index') }}" class="btn text-light rounded"
          style="background-color: #3b2621; padding-top: 10px">
          Lihat Semua
        </a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffees as $coffee)
        <div class="col">
          <div class="card rounded-3 shadow-sm product-card h-100"
            style="color: #3b2621 !important; border: 2px solid #3b2621 !important;">
            <div class="m-3 rounded" style="color: #3b2621 !important;">
              <a href=" #">
                @if($coffee->variant == 'hot')
                <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}"
                  class="card-img-top object-fit cover" alt="..." height="250px" width="300px" />
                @elseif ($coffee->variant == 'ice' || $coffee->variant == 'both')
                <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}"
                  class="card-img-top object-fit cover" alt="..." height="250px" width="300px" />
                @endif
              </a>
            </div>
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
                  @if ($coffee->variant == 'hot')
                  Rp {{ number_format($coffee->priceHot, 0, ',', '.') }}
                  @elseif ($coffee->variant == 'ice')
                  Rp {{ number_format($coffee->priceIce, 0, ',', '.') }}
                  @elseif ($coffee->variant == 'both')
                  Rp {{ number_format($coffee->priceHot, 0, ',', '.') }} -
                  {{ number_format($coffee->priceIce, 0, ',', '.') }}
                  @endif
                </span>
                {{-- See --}}
                @if($coffee->variant == 'hot')
                @if($coffee->supply_hot == 1)
                <a href="{{ route('coffees.show', $coffee->id) }}" class="btn rounded"
                  style="background-color: #3b2621; color: white">
                  Buy
                </a>
                @else
                <button class="btn rounded" style="background-color: #3b2621; color: white" disabled>
                  Out of Stock
                </button>
                @endif
                @elseif($coffee->variant == 'ice')
                @if($coffee->supply_ice == 1)
                <a href="{{ route('coffees.show', $coffee->id) }}" class="btn rounded"
                  style="background-color: #3b2621; color: white">
                  Buy
                </a>
                @else
                <button class="btn rounded" style="background-color: #3b2621; color: white" disabled>
                  Out of Stock
                </button>
                @endif
                @elseif($coffee->variant == 'both')
                @if($coffee->supply_hot == 1 && $coffee->supply_ice == 1)
                <a href="{{ route('coffees.show', $coffee->id) }}" class="btn rounded"
                  style="background-color: #3b2621; color: white">
                  Buy
                </a>
                @else
                <button class="btn rounded" style="background-color: #3b2621; color: white" disabled>
                  Out of Stock
                </button>
                @endif
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Coffee Beans --}}
    <div class="coffee-beans mt-5" id="beans">
      <div class="d-flex justify-content-between mb-4">
        <h2 class="float-start">
          Coffee Beans
        </h2>
        <a href="{{ route('coffee-beans.index') }}" class="btn text-light rounded"
          style="background-color: #3b2621; padding-top: 10px">
          Lihat Semua
        </a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffeeBeans as $coffeeBean)
        <div class="col">
          <div class="card rounded-3 shadow-sm product-card h-100"
            style="color: #3b2621 !important; border: 2px solid #3b2621;">
            <div class="m-3 rounded" style="color: #3b2621 !important;>
              <a href=" #">
              <img src="{{ asset('storage/img/products/beans/' . $coffeeBean->image) }}"
                class="card-img-top object-fit cover" alt="..." height="200px" width="300px" />
              </a>
            </div>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-truncate">
                {{ $coffeeBean->name }}
              </h5>
              <p class="card-text flex-grow-1">
                {{ Str::limit($coffeeBean->description, 50) }}
              </p>
            </div>
            <div class="card-footer bg-white border-top-0 pb-3">
              <div class="d-flex justify-content-between">
                <span class="fw-bold pt-2">
                  Rp {{ number_format($coffeeBean->price, 0, ',', '.') }}
                </span>
                <a href="{{ route('coffee-beans.show', $coffeeBean->id) }}" class="btn rounded"
                  style="background-color: #3b2621; color: white">
                  Buy
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- Coffee Machines --}}
    <div class="coffee-machines mt-5" id="machines">
      <div class="d-flex justify-content-between mb-4">
        <h2 class="float-start">
          Coffee Machines
        </h2>
        <a href="{{ route('coffee-machines.index') }}" class="btn text-light rounded"
          style="background-color: #3b2621; padding-top: 10px">
          Lihat Semua
        </a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffeeMachines as $coffeeMachine)
        <div class="col">
          <div class="card rounded-3 shadow-sm product-card h-100"
            style="color: #3b2621 !important; border: 2px solid #3b2621;">
            <div class="m-3 rounded" style="color: #3b2621 !important;>
              <a href=" #">
              <img src="{{ asset('storage/img/products/machines/' . $coffeeMachine->image) }}"
                class="card-img-top object-fit cover" alt="..." height="200px" width="300px" />
              </a>
            </div>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-truncate">
                {{ $coffeeMachine->name }}
              </h5>
              <p class="card-text flex-grow-1">
                {{ Str::limit($coffeeMachine->description, 50) }}
              </p>
            </div>
            <div class="card-footer bg-white border-top-0 pb-3">
              <div class="d-flex justify-content-between">
                <span class="fw-bold pt-2">
                  Rp {{ number_format($coffeeMachine->price, 0, ',', '.') }}
                </span>
                <a href="{{ route('coffee-machines.show', $coffeeMachine->id) }}" class="btn rounded"
                  style="background-color: #3b2621; color: white">
                  Buy
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
{{-- End of Menu Items --}}

</div>

<script>
  // Pill Active
  const pills = document.querySelectorAll('.nav-link');

  // Default Active
  pills[0].classList.add('active');

  pills.forEach(pill => {
    pill.addEventListener('click', () => {
      pills.forEach(pill => {
        pill.classList.remove('active');
      });
      pill.classList.add('active');
    });
  });

</script>

@endsection