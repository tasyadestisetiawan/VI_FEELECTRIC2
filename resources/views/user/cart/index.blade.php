@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <!-- Cart Items -->
      <div class="col-md-8 mb-4">
        <h3>
          <i class="bi bi-cart3"></i>
          Cart Orders
        </h3>
        <hr>
        <div class="card shadow border-0 p-2">
          <ul class="list-group list-group-flush">
            @forelse($cartItems as $cartItem)
            <li class="list-group-item">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  @foreach($coffees as $coffee)
                  @if($cartItem->product_id == $coffee->id)
                  @if ($cartItem->temperature == 'hot')
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" class="img-fluid rounded"
                    style="width: 90px; height: 90px; margin-right: 15px;" alt="Espresso Double">
                  @elseif ($cartItem->temperature == 'ice')
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}" class="img-fluid rounded"
                    style="width: 90px; height: 90px; margin-right: 15px;" alt="Espresso Double">
                  @endif
                  @endif
                  @endforeach
                  <div>
                    <h5 class="mb-1">
                      @foreach($coffees as $coffee)
                      @if($cartItem->product_id == $coffee->id)
                      {{ $coffee->name }}
                      @endif
                      @endforeach
                    </h5>
                    <div class="variants">
                      {{-- Badge --}}
                      <span class="badge bg-secondary">
                        {{ $cartItem->quantity }} x
                      </span>
                      {{-- Temperature --}}
                      <span class="badge bg-warning">
                        {{ $cartItem->temperature }}
                      </span>
                    </div>
                    <p class="mb-0 mt-3">
                    <blockquote
                      style="font-size: 0.9em; font-style: italic; color: #6c757d; border-left: 2px solid #6c757d; padding-left: 10px; margin-top: 0; background-color: #26552634; padding: 6px;">
                      {{ $cartItem->notes }}
                    </blockquote>
                    </p>
                  </div>
                </div>
                <div>
                  <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-outline-primary btn-sm m-2" data-bs-toggle="modal"
                      data-bs-target="#productModal">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm m-2"
                        onclick="return confirm('Are you sure you want to delete this item?')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                  <div class="text-dark fw-bold mt-3">
                    Rp{{ number_format($cartItem->total_price, 0, ',', '.') }}
                  </div>
                </div>
              </div>
            </li>
            @empty
            <li class="list-group-item">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="text-center">
                    <h5 class="mb-1" style="color: #6c757d;">
                      No items in the cart
                    </h5>
                  </div>
                </div>
              </div>
            </li>
            @endforelse
          </ul>
        </div>
      </div>

      <!-- Pickup Detail -->
      <div class="col-md-4">
        <h3 class="card-title">
          <i class="bi bi-cash-coin"></i>
          Pickup Detail
        </h3>
        <hr>
        <form action="{{ route('orders.store') }}" method="POST">
          @csrf
          <div class="card rounded shadow border-0 p-3">

            <!-- Pickup Type -->
            <div class="mb-3">
              <label for="pickupType" class="form-label">
                Pickup Type
              </label>
              <select class="form-select" id="pickupType" name="pickupType">
                <option value="place">Dine In</option>
                <option value="home">Take Away</option>
              </select>
            </div>

            <!-- Pickup Date & Time -->
            <div class="mb-3">
              <label for="pickupDate" class="form-label">
                Pick Date & Time
              </label>
              <input type="datetime-local" class="form-control" id="pickupDate" name="pickupDate" required>
            </div>

            <!-- Payment Method -->
            <input class="form-check" type="radio" name="paymentMethod" id="cash" value="cash" checked hidden>

            <!-- Payment Detail -->
            <div class="mb-3">
              <label class="form-label mb-0 fw-bold">
                Payment
              </label>
              <table class="table">
                <tr>
                  <td>Sub-Total</td>
                  <td>:</td>
                  <td id="sub-total"></td>
                  <!-- Input -->
                  <input type="hidden" id="sub-total-input" name="subTotal">
                </tr>
              </table>
            </div>

            <!-- Hidden Notes : Value From Cart Notes -->
            <input type="hidden" name="note" value="{{ json_encode($cartItems->pluck('notes')) }}">

            <!-- Products Information - Hidden (JSON) -->
            <input type="hidden" name="products" value="{{ json_encode($cartItems) }}">

            <!-- Personal Information -->
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" hidden>
            <input type="phone" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" hidden>

            <!-- Checkout -->
            <div class="mb-3 mx-3">
              <div class="row">
                <button type="submit" class="btn btn-sm w-100 py-2" style="background-color: #265526; color: white;">
                  Order Now
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>

  <!-- Modal Edit Cart Item -->
  @foreach($cartItems as $cartItem)
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="productModalLabel">
            @foreach($coffees as $coffee)
            @if($cartItem->product_id == $coffee->id)
            {{ $coffee->name }}
            @endif
            @endforeach
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body p-4">
            <div class="row">
              <div class="col-5">
                <div class="mb-3">
                  <!-- Product Image 250px -->
                  @foreach($coffees as $coffee)
                  @if($cartItem->product_id == $coffee->id)
                  @if ($cartItem->temperature == 'hot')
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}" class="img-fluid rounded"
                    style="width: 150px; height: 150px;" alt="Espresso Double">
                  @elseif ($cartItem->temperature == 'ice')
                  <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}" class="img-fluid rounded"
                    style="width: 150px; height: 150px;" alt="Espresso Double">
                  @endif
                  @endif
                  @endforeach
                </div>
              </div>
              <div class="col-7">
                <div class="mb-3">
                  <label for="quantity" class="form-label">
                    Quantity
                  </label>
                  <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ $cartItem->quantity }}">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="temperature" class="form-label">
                Variant
              </label>
              <select class="form-select mb-3" name="temperature">
                <option selected>Choose Variant</option>
                @foreach( $coffees as $coffee )
                  @if ($cartItem->product_id == $coffee->id)
                    @if ($coffee->temperature == 'hot')
                      <option value="hot" {{ $cartItem->temperature == 'hot' ? 'selected' : '' }}>Hot</option>
                    @elseif ($coffee->temperature == 'ice')
                      <option value="ice" {{ $cartItem->temperature == 'ice' ? 'selected' : '' }}>Ice</option>
                    @else
                      <option value="hot" {{ $cartItem->temperature == 'hot' ? 'selected' : '' }}>Hot</option>
                      <option value="ice" {{ $cartItem->temperature == 'ice' ? 'selected' : '' }}>Ice</option>
                    @endif
                  @endif
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="notes" class="form-label">
                Notes
              </label>
              <textarea class="form-control" id="notes" name="notes" rows="3">{{ $cartItem->notes }}</textarea>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-sm w-100 py-2" style="background-color: #265526; color: white;">
                  Update Cart Item
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>

@php
  $totalPrice = 0;
  foreach($cartItems as $cartItem) {
    $totalPrice += $cartItem->total_price;
  }
@endphp

<script>
  let totalPrice = {{$totalPrice}};
  let formattedTotalPrice = 'Rp ' + totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  document.getElementById('sub-total').innerHTML = formattedTotalPrice;
  document.getElementById('sub-total-input').value = totalPrice;
</script>

@endsection