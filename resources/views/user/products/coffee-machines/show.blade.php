@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
    <div class="row mt-4">
        <div class="col-md-6">
            {{-- Machines Image --}}
            <img src="{{ asset('storage/img/products/machines/' . $product->image) }}" class="img-fluid"
                alt="{{ $product->name }}" style="border-radius: 10px 10px 0 0; object-fit: cover; height: 500px;">
        </div>
        <div class="col-md-6">
            <h2>
                {{ $product->name }}
            </h2>
            <p class="text-muted">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <p>
                {{ $product->description }}
            </p>

            <form action="{{ route('cart.store') }}" method="POST" class="mt-4">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="size" value="{{ $product->weight }}">
                <input type="hidden" name="type" value="machine">

                {{-- Notes --}}
                <label for="" class="form-label">
                    <strong>Notes</strong>
                </label>
                <textarea class="form-control mb-3" rows="3" placeholder="Contoh: packing yang rapih"
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
            <div class="card shadow-sm rounded pb-3" style="border: solid 2px #3b2621">
                <div class="m-3">
                    <img src="{{ asset('storage/img/products/machines/' . $recommendedProduct->image) }}"
                        class="card-img-top object-fit cover" alt="..." height="250px" />
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        {{ $recommendedProduct->name }}
                    </h5>
                    <span class="fw-bold">
                        Rp {{ number_format($recommendedProduct->price, 0, ',', '.') }}
                    </span>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('coffee-machines.show', $recommendedProduct->id) }}"
                            class="btn text-light rounded" style="background-color: #3b2621">
                            Buy
                        </a>
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