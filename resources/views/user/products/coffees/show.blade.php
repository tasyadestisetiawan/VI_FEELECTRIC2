@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
    <div class="row mt-4">
        <div class="col-md-6">
            @if ($product->variant == 'hot')
            <img src="{{ asset('storage/img/products/coffees/' . $product->imageHot) }}" alt="Product Image"
                class="img-fluid rounded shadow-sm" style="width: 500px;">
            @elseif ($product->variant == 'ice')
            <img src="{{ asset('storage/img/products/coffees/' . $product->imageIce) }}" alt="Product Image"
                class="img-fluid rounded shadow-sm" style="width: 500px;">
            @else
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/img/products/coffees/' . $product->imageHot) }}" alt="Product Image"
                        class="img-fluid rounded shadow-sm" style="width: 500px;">
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('storage/img/products/coffees/' . $product->imageIce) }}" alt="Product Image"
                        class="img-fluid rounded shadow-sm" style="width: 500px;">
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <h2>
                {{ $product->name }}
            </h2>
            <p class="text-muted">
                @if ($product->variant == 'hot')
                <span class="badge bg-danger">Hot</span>
                <span class="fw-bold">
                    Rp {{ number_format($product->priceHot, 0, ',', '.') }}
                </span>
                @elseif ($product->variant == 'ice')
                <span class="badge bg-primary">Ice</span>
                <span class="fw-bold">
                    Rp {{ number_format($product->priceIce, 0, ',', '.') }}
                </span>
                @elseif ($product->variant == 'both')
                <span class="badge bg-danger">Hot</span>
                <span class="fw-bold">
                    Rp {{ number_format($product->priceHot, 0, ',', '.') }}
                </span>
                <span class="badge bg-primary">Ice</span>
                <span class="fw-bold">
                    Rp {{ number_format($product->priceIce, 0, ',', '.') }}
                </span>
                @endif
            </p>
            <p>
                {{ $product->description }}
            </p>

            <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="type" value="drink">

                {{-- Variant HOT/ICE --}}
                <label for="" class="form-label">
                    <strong>Variant</strong>
                </label>
                <select class="form-select mb-3" name="temperature">
                    <option selected>Choose Variant</option>
                    @if ($product->variant == 'both')
                    <option value="hot">Hot</option>
                    <option value="ice">Ice</option>
                    @elseif ($product->variant == 'hot')
                    <option value="hot">Hot</option>
                    @elseif ($product->variant == 'ice')
                    <option value="ice">Ice</option>
                    @endif
                </select>

                {{-- Price --}}
                @if ($product->variant == 'hot')
                <input type="hidden" name="price" value="{{ $product->priceHot }}">
                @elseif ($product->variant == 'ice')
                <input type="hidden" name="price" value="{{ $product->priceIce }}">
                @elseif ($product->variant == 'both')
                <input type="hidden" name="price" id="priceBoth">
                @endif

                {{-- Notes --}}
                <label for="" class="form-label">
                    <strong>Notes</strong>
                </label>
                <textarea class="form-control mb-3" rows="3" placeholder="Example: Add sugar, Less sugar, etc"
                    name="notes"></textarea>

                {{-- Quantity --}}
                <label for="" class="form-label">
                    <strong>Quantity</strong>
                </label>
                <div class="d-flex mb-3">
                    <input type="number" class="form-control w-auto me-2" value="1" name="quantity">
                    @auth
                    <button type="submit" class="btn text-light" style="background-color: #3b2621">Add To Cart</button>
                    @else
                    <a href="{{ route('login') }}" class="btn text-light" style="background-color: #3b2621">Login To Add
                        To Cart</a>
                    @endauth
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-4 mb-5">
    <h2 class="mb-3">Produk Terkait</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($recommendedProducts as $recommendedProduct)
        <div class="col">
            <div class="card shadow-sm rounded-3 pb-3 mb-3" style="border: solid 2px #3b2621">
                <div class="m-3">
                    @if ($recommendedProduct->variant == 'hot')
                    <img src="{{ asset('storage/img/products/coffees/' . $recommendedProduct->imageHot) }}"
                        class="card-img-top" alt="Espresso Single">
                    @elseif ($recommendedProduct->variant == 'ice')
                    <img src="{{ asset('storage/img/products/coffees/' . $recommendedProduct->imageIce) }}"
                        class="card-img-top" alt="Espresso Single">
                    @else
                    <img src="{{ asset('storage/img/products/coffees/' . $recommendedProduct->imageHot) }}"
                        class="card-img-top" alt="Espresso Single">
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        {{ $recommendedProduct->name }}
                    </h5>
                    <span class="fw-bold">
                        @if ($recommendedProduct->variant == 'hot')
                        Rp {{ number_format($recommendedProduct->priceHot, 0, ',', '.') }}
                        @elseif ($recommendedProduct->variant == 'ice')
                        Rp {{ number_format($recommendedProduct->priceIce, 0, ',', '.') }}
                        @else
                        Rp {{ number_format($recommendedProduct->priceHot, 0, ',', '.') }} -
                        {{ number_format($recommendedProduct->priceIce, 0, ',', '.') }}
                        @endif
                    </span>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('coffees.show', $recommendedProduct->id) }}" class="btn text-light rounded"
                            style="background-color: #3b2621">Buy</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

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

<script>
    // Inputkan Harga berdasarkan variant, jika variant both
    const temperature = document.querySelector('select[name="temperature"]');
    const priceBoth = document.getElementById('priceBoth');

    temperature.addEventListener('change', function() {
        if (temperature.value == 'hot') {
            priceBoth.value = '{{ $product->priceHot }}';
        } else if (temperature.value == 'ice') {
            priceBoth.value = '{{ $product->priceIce }}';
        }
    });

</script>

@endsection