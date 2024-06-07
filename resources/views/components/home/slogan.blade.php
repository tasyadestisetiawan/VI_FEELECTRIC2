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
                                            <button type="button" class="btn rounded"
                                                style="background-color: #3b2621; color: white" data-bs-toggle="modal"
                                                data-bs-target="#modalShowCoffee{{ $coffee->id }}">
                                                See More
                                            </button>
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
                                            {{-- See --}}
                                            <button type="button" class="btn rounded"
                                                style="background-color: #3b2621; color: white" data-bs-toggle="modal"
                                                data-bs-target="#modalShowCoffeeBean{{ $coffeeBean->id }}">
                                                See More
                                            </button>
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

{{-- Modal Show untuk Coffee --}}
@foreach ($coffees as $coffee)
<div class="modal fade" id="modalShowCoffee{{ $coffee->id }}" tabindex="-1"
    aria-labelledby="modalShowCoffee{{ $coffee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: #f8f9fa; border: 2px solid #3b2621;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowCoffee{{ $coffee->id }}">
                    {{ $coffee->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($coffee->variant == 'ice')
                <div class="row">
                    <div class="col-5">
                        <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}"
                            class="card-img-top object-fit cover" alt="..." width="250px" />
                    </div>
                    <div class="col-7">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Product Name</th>
                                    <td>{{ $coffee->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $coffee->description }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Variant</th>
                                    <td>{{ $coffee->variant }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Supply</th>
                                    <td>
                                        @if ($coffee->supply_ice == 0)
                                        Out of Stock
                                        @else
                                        Available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>Rp {{ number_format($coffee->priceIce, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @elseif ($coffee->variant == 'hot')
                <div class="row">
                    <div class="col-5">
                        <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}"
                            class="card-img-top object-fit cover" alt="..." width="250px" />
                    </div>
                    <div class="col-7">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Product Name</th>
                                    <td>{{ $coffee->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $coffee->description }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Variant</th>
                                    <td>{{ $coffee->variant }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Supply</th>
                                    <td>
                                        @if ($coffee->supply_hot == 0)
                                        Out of Stock
                                        @else
                                        Available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>Rp {{ number_format($coffee->priceHot, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @elseif ($coffee->variant == 'both')
                <div class="row">
                    <div class="col-5">
                        <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}"
                            class="card-img-top object-fit cover" alt="..." width="250px" />
                    </div>
                    <div class="col-7">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Product Name</th>
                                    <td>{{ $coffee->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $coffee->description }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Variant</th>
                                    <td>Hot & Ice</td>
                                </tr>
                                <tr>
                                    <th scope="row">Supply</th>
                                    <td>
                                        @if ($coffee->supply_hot == 0 && $coffee->supply_ice == 0)
                                        Out of Stock
                                        @else
                                        Available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>Rp {{ number_format($coffee->priceHot, 0, ',', '.') }} -
                                        {{ number_format($coffee->priceIce, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                @if ($coffee->supply_hot == 0 && $coffee->supply_ice == 0)
                <button type="button" class="btn" style="background-color: #3b2621; color: white" disabled>
                    Out of Stock
                </button>
                @else
                <a href="{{ route('coffees.show', $coffee->id) }}" class="btn"
                    style="background-color: #3b2621; color: white">
                    Buy Now
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- End of Modal Show untuk Coffee --}}

{{-- Modal Show untuk Coffee Bean --}}
@foreach ($coffeeBeans as $coffeeBean)
<div class="modal fade" id="modalShowCoffeeBean{{ $coffeeBean->id }}" tabindex="-1"
    aria-labelledby="modalShowCoffeeBean{{ $coffeeBean->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: #f8f9fa; border: 2px solid #3b2621;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowCoffeeBean{{ $coffeeBean->id }}">
                    {{ $coffeeBean->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5">
                        <img src="{{ asset('storage/img/products/beans/' . $coffeeBean->image) }}"
                            class="card-img-top object-fit cover" alt="..." width="250px" />
                    </div>
                    <div class="col-7">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Product Name</th>
                                    <td>{{ $coffeeBean->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Description</th>
                                    <td>{{ $coffeeBean->description }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Supply</th>
                                    <td>
                                        @if ($coffeeBean->stock == 0)
                                        Out of Stock
                                        @else
                                        Available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>Rp {{ number_format($coffeeBean->price, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if ($coffeeBean->stock == 0)
                <button type="button" class="btn" style="background-color: #3b2621; color: white" disabled>
                    Out of Stock
                </button>
                @else
                <a href="{{ route('coffee-beans.show', $coffeeBean->id) }}" class="btn"
                    style="background-color: #3b2621; color: white">
                    Buy Now
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- End of Modal Show untuk Coffee Bean --}}

<!-- End About Section -->