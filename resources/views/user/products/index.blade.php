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
    <form action="{{ route('products.search') }}" method="POST">
      @csrf
      <div class="input-group w-auto rounded-pill">
        <span class="input-group-text" style="background-color: white">
          <a href="#">
            <i class="bi bi-search" style="color: #3b2621"></i>
          </a>
        </span>
        <input type="text" name="search" class="form-control" placeholder="Mau minum apa hari ini..."
          aria-label="Search" />
      </div>
    </form>
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
        <a href="{{ route('coffees.index') }}" class="btn text-light rounded" style="background-color: #3b2621; padding-top: 10px">
          Lihat Semua
        </a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffees as $coffee)
        <div class="col">
          <div class="card rounded-3 shadow-sm product-card h-100" style="color: #3b2621 !important; border: 2px solid #3b2621 !important;">
            <div class="m-3 rounded" style="color: #3b2621 !important;">
              <a href="#">
                @if($coffee->variant == 'hot')
                <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" class="card-img-top object-fit cover" alt="..." height="250px" width="300px" />
                @elseif ($coffee->variant == 'ice' || $coffee->variant == 'both')
                <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}" class="card-img-top object-fit cover" alt="..." height="250px" width="300px" />
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
                <a href="#" class="btn btn-primary" style="background-color: #3B2621;" data-bs-toggle="modal" data-bs-target="#productModal{{ $coffee->id }}">Buy
                </a>
                @else
                <button class="btn rounded" style="background-color: #3b2621; color: white" disabled>
                  Out of Stock
                </button>
                @endif
                @elseif($coffee->variant == 'ice')
                @if($coffee->supply_ice == 1)
                <a href="#" class="btn btn-primary" style="background-color: #3B2621;" data-bs-toggle="modal" data-bs-target="#productModal{{ $coffee->id }}">Buy
                </a>
                @else
                <button class="btn rounded" style="background-color: #3b2621; color: white" disabled>
                  Out of Stock
                </button>
                @endif
                @elseif($coffee->variant == 'both')
                @if($coffee->supply_hot == 1 && $coffee->supply_ice == 1)
                <a href="#" class="btn btn-primary" style="background-color: #3B2621;" data-bs-toggle="modal" data-bs-target="#productModal{{ $coffee->id }}">Buy
                </a>
                @else
                <button class="btn rounded" style="background-color: #3b262175; color: white" disabled>
                  Out of Stock
                </button>
                @endif
                @endif
              </div>
            </div>
          </div>
        </div>

        {{-- Modal Coffee --}}
        <div class="modal fade" id="productModal{{ $coffee->id }}" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f8f5f0; border-radius: 15px;">
              <div class="modal-header p-3" style="border-bottom: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-3">
                <!-- Content -->
                <div class="container ">
                  <div class="row mt-3">
                    <div class="col-md-6">
                      @if ($coffee->variant == 'hot')
                      <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" alt="Product Image" class="img-fluid rounded shadow-sm" style="width: 100%;">
                      @elseif ($coffee->variant == 'ice')
                      <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}" alt="Product Image" class="img-fluid rounded shadow-sm" style="width: 100%;">
                      @else
                      <div class="row">
                        <div class="col-md-6">
                          <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" alt="Product Image" class="img-fluid rounded shadow-sm" style="width: 100%;">
                        </div>
                        <div class="col-md-6">
                          <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}" alt="Product Image" class="img-fluid rounded shadow-sm" style="width: 100%;">
                        </div>
                      </div>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <h2>
                        {{ $coffee->name }}
                      </h2>
                      <p class="text-muted">
                        @if ($coffee->variant == 'hot')
                        <span class="badge bg-danger">Hot</span>
                        <span class="fw-bold">
                          Rp {{ number_format($coffee->priceHot, 0, ',', '.') }}
                        </span>
                        @elseif ($coffee->variant == 'ice')
                        <span class="badge bg-primary">Ice</span>
                        <span class="fw-bold">
                          Rp {{ number_format($coffee->priceIce, 0, ',', '.') }}
                        </span>
                        @elseif ($coffee->variant == 'both')
                        <span class="badge bg-danger">Hot</span>
                        <span class="fw-bold">
                          Rp {{ number_format($coffee->priceHot, 0, ',', '.') }}
                        </span>
                        <span class="badge bg-primary">Ice</span>
                        <span class="fw-bold">
                          Rp {{ number_format($coffee->priceIce, 0, ',', '.') }}
                        </span>
                        @endif
                      </p>
                      <p>
                        {{ $coffee->description }}
                      </p>
                    </div>
                  </div>
                  <div class="row mt-3 ps-2">
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                      @csrf

                      <input type="hidden" name="product_id" value="{{ $coffee->id }}">
                      <input type="hidden" name="name" value="{{ $coffee->name }}">
                      <input type="hidden" name="type" value="drink">

                      {{-- Variant HOT/ICE --}}
                      <label for="" class="form-label">
                        <strong>Variant</strong>
                      </label>
                      <select class="form-select mb-3" name="temperature" style="border: solid !important; border: width 1.5px !important;">
                        <option selected>Choose Variant</option>
                        @if ($coffee->variant == 'both')
                        <option value="hot">Hot</option>
                        <option value="ice">Ice</option>
                        @elseif ($coffee->variant == 'hot')
                        <option value="hot">Hot</option>
                        @elseif ($coffee->variant == 'ice')
                        <option value="ice">Ice</option>
                        @endif
                      </select>

                      {{-- Price --}}
                      @if ($coffee->variant == 'hot')
                      <input type="hidden" name="price" value="{{ $coffee->priceHot }}">
                      @elseif ($coffee->variant == 'ice')
                      <input type="hidden" name="price" value="{{ $coffee->priceIce }}">
                      @elseif ($coffee->variant == 'both')
                      <input type="hidden" name="price" id="priceBoth">
                      @endif

                      {{-- Notes --}}
                      <label for="" class="form-label">
                        <strong>Notes</strong>
                      </label>
                      <textarea class="form-control mb-3" rows="3" style="border: solid !important; border: width 1.5px !important;" placeholder="Example: Add sugar, Less sugar, etc" name="notes"></textarea>

                      {{-- Quantity --}}
                      <label for="" class="form-label">
                        <strong>Quantity</strong>
                      </label>
                      <div class="d-flex justify-content-between mb-2">
                        <input type="number" class="form-control w-auto me-2" value="1" name="quantity" style="border: solid !important; border: width 1.5px !important;">
                        @auth
                        <button type="submit" class="btn text-light" style="background-color: #3b2621">Add To Cart</button>
                        @else
                        <a href="{{ route('login') }}" class="btn text-light" style="background-color: #3b2621">Login To Add To Cart</a>
                        @endauth
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="coffee-beans mt-5" id="beans">
      <div class="d-flex justify-content-between mb-4">
        <h2 class="float-start">
          Coffee Beans
        </h2>
        <a href="{{ route('coffee-beans.index') }}" class="btn text-light rounded" style="background-color: #3b2621; padding-top: 10px">
          Lihat Semua
        </a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffeeBeans as $coffeeBean)
        <div class="col">
          <div class="card rounded-3 shadow-sm product-card h-100" style="color: #3b2621 !important; border: 2px solid #3b2621;">
            <div class="m-3 rounded" style="color: #3b2621 !important;">
              <a href="#">
                <img src="{{ asset('storage/img/products/beans/' . $coffeeBean->image) }}" class="card-img-top object-fit cover" alt="..." height="200px" width="300px" />
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
                @if ($coffeeBean->stock == 0)
                <button class="btn text-light rounded" style="background-color: #3b262175; color: white" disabled>
                  Out of Stock
                </button>
                @else
                <a href="#" class="btn btn-primary" style="background-color: #3B2621;" data-bs-toggle="modal" data-bs-target="#coffeeBeanModal{{ $coffeeBean->id }}">Buy
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Modal CoffeeBean -->
        <div class="modal fade" id="coffeeBeanModal{{ $coffeeBean->id }}" tabindex="-1" aria-labelledby="coffeeBeanModalLabel{{ $coffeeBean->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f8f5f0; border-radius: 15px;">
              <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="padding: 20px;">
                <!-- Content -->
                <div class="container p-2">
                  <div class="row">
                    <div class="col-md-6">
                      {{-- CoffeeBeans Image --}}
                      <img src="{{ asset('storage/img/products/beans/' . $coffeeBean->image) }}" class="img-fluid" alt="{{ $coffeeBean->name }}" style="border-radius: 10px 10px 0 0; object-fit: cover; width: 100%;">
                    </div>
                    <div class="col-md-6">
                      <h2>
                        {{ $coffeeBean->name }}
                      </h2>
                      <p class="text-muted">
                        Rp {{ number_format($coffeeBean->price, 0, ',', '.') }} / {{ $coffeeBean->weight }}
                      </p>
                      <p>
                        {{ $coffeeBean->description }}
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                      @csrf

                      <input type="hidden" name="product_id" value="{{ $coffeeBean->id }}">
                      <input type="hidden" name="price" value="{{ $coffeeBean->price }}">
                      <input type="hidden" name="size" value="{{ $coffeeBean->weight }}">
                      <input type="hidden" name="type" value="bean">

                      {{-- Notes --}}
                      <label for="" class="form-label">
                        <strong>Notes</strong>
                      </label>
                      <textarea class="form-control mb-3" rows="3" style="border: solid !important; border: width 1.5px !important;" placeholder="Contoh: packing yang rapih" name="notes"></textarea>

                      {{-- Quantity --}}
                      <label for="" class="form-label">
                        <strong>Quantity</strong>
                      </label>
                      <div class="d-flex">
                        <input type="number" class="form-control w-auto me-2" value="1" name="quantity" style="border: solid !important; border: width 1.5px !important;">
                        @auth
                        <button type="submit" class="btn text-light" style="background-color: #3b2621">Add To Cart</button>
                        @else
                        <a href="{{ route('login') }}" class="btn text-light" style="background-color: #3b2621">Login To Add To Cart</a>
                        @endauth
                      </div>
                    </form>
                  </div>
                </div>

              </div>
              <div class="modal-footer">

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
        <a href="{{ route('coffee-machines.index') }}" class="btn text-light rounded" style="background-color: #3b2621; padding-top: 10px">
          Lihat Semua
        </a>
      </div>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffeeMachines as $coffeeMachine)
        <div class="col">
          <div class="card rounded-3 shadow-sm product-card h-100" style="color: #3b2621 !important; border: 2px solid #3b2621;">
            <div class="m-3 rounded" style="color: #3b2621 !important;">
              <a href="#">
                <img src="{{ asset('storage/img/products/machines/' . $coffeeMachine->image) }}" class="card-img-top object-fit cover" alt="..." height="200px" width="300px" />
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
                @if ($coffeeMachine->stock == 0)
                <button type="disable" class="btn text-light rounded" style="background-color: #3b262185; color: white">
                  Out of Stock
                </button>
                @else
                <a href="#" class="btn text-light rounded" style="background-color: #3b2621; color: white" data-bs-toggle="modal" data-bs-target="#coffeeMachineModal{{ $coffeeMachine->id }}">
                  Buy
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Coffee Machine -->
        <div class="modal fade" id="coffeeMachineModal{{ $coffeeMachine->id }}" tabindex="-1" aria-labelledby="coffeeMachineModalLabel{{ $coffeeMachine->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #f8f5f0; border-radius: 15px;">
              <div class="modal-header" style="border-bottom: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" style="padding: 20px;">
                <!-- Content -->
                <div class="container p-2">
                  <div class="row">
                    <div class="col-md-6">
                      {{-- Coffee Machine Image --}}
                      <img src="{{ asset('storage/img/products/machines/' . $coffeeMachine->image) }}" class="img-fluid" alt="{{ $coffeeMachine->name }}" style="border-radius: 10px 10px 0 0; object-fit: cover; width: 100%;">
                    </div>
                    <div class="col-md-6">
                      <h2>
                        {{ $coffeeMachine->name }}
                      </h2>
                      <p class="text-muted">
                        Rp {{ number_format($coffeeMachine->price, 0, ',', '.') }}
                      </p>
                      <p>
                        {{ $coffeeMachine->description }}
                      </p>
                    </div>
                  </div>
                  <div class="row">
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                      @csrf

                      <input type="hidden" name="product_id" value="{{ $coffeeMachine->id }}">
                      <input type="hidden" name="price" value="{{ $coffeeMachine->price }}">
                      <input type="hidden" name="type" value="machine">

                      {{-- Notes --}}
                      <label for="" class="form-label">
                        <strong>Notes</strong>
                      </label>
                      <textarea class="form-control mb-3" rows="3" style="border: solid !important; border: width 1.5px !important;" placeholder="Contoh: packing yang rapih" name="notes"></textarea>

                      {{-- Quantity --}}
                      <label for="" class="form-label">
                        <strong>Quantity</strong>
                      </label>
                      <div class="d-flex">
                        <input type="number" class="form-control w-auto me-2" value="1" name="quantity" style="border: solid !important; border: width 1.5px !important;">
                        @auth
                        <button type="submit" class="btn text-light" style="background-color: #3b2621">Add To Cart</button>
                        @else
                        <a href="{{ route('login') }}" class="btn text-light" style="background-color: #3b2621">Login To Add To Cart</a>
                        @endauth
                      </div>
                    </form>
                  </div>
                </div>

              </div>
              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
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