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
        <a class="nav-link active rounded-pill" style="background-color: #3b2621" href="#">Semua</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
          href="#ordinaryCoffe">Ordinary Coffee</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
          href="#manualBrew">Manual Brew</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
          href="#latteNonCoffe">Latte Non Coffee</a>
      </li>
      <li class="nav-item">
        <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
          href="#feelTheSignature">Feel The Signature</a>
      </li>
    </ul>
  </div>

  {{-- Menu Items --}}
  <div class="container mt-5">
    <h2 class="mb-4" id="#ordinaryCoffe">Ordinary Coffee</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
      @foreach ($coffees as $coffee)
      <div class="col">
        <div class="card border-0 shadow-sm product-card h-100" style="color: #3b2621">
          <a href="menu-detail.html">
            @if($coffee->variant == 'hot')
            <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}"
              class="card-img-top object-fit cover" alt="..." height="250px" />
            @elseif ($coffee->variant == 'ice' || $coffee->variant == 'both')
            <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}"
              class="card-img-top object-fit cover" alt="..." height="250px" />
            @endif
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
                @if ($coffee->variant == 'hot')
                Rp {{ number_format($coffee->priceHot, 0, ',', '.') }}
                @elseif ($coffee->variant == 'ice')
                Rp {{ number_format($coffee->priceIce, 0, ',', '.') }}
                @elseif ($coffee->variant == 'both')
                Rp {{ number_format($coffee->priceHot, 0, ',', '.') }} -
                {{ number_format($coffee->priceIce, 0, ',', '.') }}
                @endif
              </span>
              <a href="{{ route('products.show', $coffee->id) }}" class="btn text-light rounded"
                style="background-color: #3b2621">Lihat</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  {{-- End of Menu Items --}}

</div>
@endsection