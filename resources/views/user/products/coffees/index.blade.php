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
        <a class="nav-link active rounded-pill" style="background-color: #3b2621" href="#">Semua</a>
      </li>
      @foreach ( $categories as $category )
      <li class="nav-item">
        <a class="nav-link rounded-pill" id="{{ $category->name }}" href="#">{{ $category->name }}</a>
      </li>
      @endforeach
    </ul>
  </div>

  {{-- Menu Items --}}
  <div class="container mt-5">

    {{-- Coffees Drink --}}
    <div class="coffes-drink">
      <div class="d-flex justify-content-between mb-4">
        <h2 class="float-start">
          Coffee Drinks
        </h2>
      </div>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        @foreach ($coffees as $coffee)
        {{-- Tampilkan berdasarkan kategori --}}
        @foreach ($categories as $category)
        @if ($coffee->category_id == $category->id)
        <div class="col" data-category="{{ $category->id }}">
          <div class="col">
            <div class="card rounded-3 shadow-sm product-card h-100"
              style="color: #3b2621 !important; border: 2px solid #3b2621;">
              <div class="m-3 rounded" style="color: #3b2621 !important;>
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
                <div class="d-flex justify-content-between mb-2">
                  <span class="badge rounded bg-primary">
                    {{ $coffee->variant }}
                  </span>
                </div>
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
                  <a href="{{ route('coffees.show', $coffee->id) }}" class="btn rounded"
                    style="background-color: #3b2621; color: white">
                    Buy
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  // Filter Coffees
  $(document).ready(function () {
    $('.nav-link').click(function () {
      let category = $(this).attr('id');
      $('.coffes-drink .col').each(function () {
        if (category == 'Semua') {
          $(this).show();
        } else {
          let categoryItem = $(this).data('category');
          if (categoryItem != category) {
            $(this).hide();
          } else {
            $(this).show();
          }
        }
      });
    });
  });
</script>

@endsection