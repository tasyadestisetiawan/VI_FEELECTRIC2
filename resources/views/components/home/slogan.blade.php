<!-- ======= About Section ======= -->
<section id="slogan" class="slogan">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="" id="all">
                    {{-- Coffees Drink --}}
                    <div class="coffes-drink" id="drinks">
                        <div class="d-flex justify-content-between mb-4">
                            <h2 class="float-start">
                                Coffees Drink <span class="badge"
                                    style="background-color: #3b2621; color: white">Popular</span>
                            </h2>
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
                                                class="card-img-top object-fit cover" alt="..." height="200px"
                                                width="300px" />
                                            @elseif ($coffee->variant == 'ice' || $coffee->variant == 'both')
                                            <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}"
                                                class="card-img-top object-fit cover" alt="..." height="200px"
                                                width="300px" />
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
                                            <a href="{{ route('coffees.show', $coffee->id) }}" class="btn rounded"
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

                    {{-- Coffee Beans --}}
                    <div class="coffee-beans mt-5" id="beans">
                        <div class="d-flex justify-content-between mb-4">
                            <h2 class="float-start">
                                Coffee Beans <span class="badge"
                                    style="background-color: #3b2621; color: white">Popular</span>
                            </h2>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                            @foreach ($coffeeBeans as $coffeeBean)
                            <div class="col">
                                <div class="card rounded-3 shadow-sm product-card h-100"
                                    style="color: #3b2621 !important; border: 2px solid #3b2621;">
                                    <div class="m-3 rounded" style="color: #3b2621 !important;>
                              <a href=" #">
                                        <img src="{{ asset('storage/img/products/beans/' . $coffeeBean->image) }}"
                                            class="card-img-top object-fit cover" alt="..." height="200px"
                                            width="300px" />
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
                                            <a href="{{ route('coffee-beans.show', $coffeeBean->id) }}"
                                                class="btn rounded" style="background-color: #3b2621; color: white">
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
        </div>
    </div>
</section>
<!-- End About Section -->