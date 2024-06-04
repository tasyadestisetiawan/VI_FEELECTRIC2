@extends('layouts.home')

@php
$hasDrink = $cartItems->contains(function ($cartItem) {
return $cartItem->type == 'drink';
});
@endphp

<style>
  /* Nav Tab */
  .nav-pills .nav-link {
    color: #3b2621;
    background-color: #fff7e8;
    border: solid 2px #3b2621;
    margin-right: 2px !important;
  }

  .nav-pills .nav-link.active {
    color: #fff7e8;
    background-color: #3b2621 !important;
  }

  .nav-pills .nav-link:hover {
    color: #fff7e8 !important;
    background-color: #3b2621 !important;
  }
</style>

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

        <div class="card p-2 rounded-4 shadow-sm w-100" style="border: solid 2px #3b2621;">

          <ul class="nav nav-pills mb-3 m-2" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active rounded-3" id="pills-home-tab" data-bs-toggle="pill"
                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                aria-selected="true">Drinks</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Beans</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Machines</button>
            </li>
          </ul>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
              tabindex="0">
              {{-- CartItem with type drink --}}
              <ul class="list-group list-group-flush">
                @forelse($cartItems as $cartItem)
                @if ($cartItem->type == 'drink')
                <li class="list-group-item">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      @foreach($coffees as $coffee)
                      @if($cartItem->product_id == $coffee->id)
                      @if ($cartItem->temperature == 'hot')
                      <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageHot) }}"
                        class="img-fluid rounded" style="width: 90px; height: 90px; margin-right: 15px;"
                        alt="Espresso Double">
                      @elseif ($cartItem->temperature == 'ice')
                      <img src="{{ asset('storage/img/products/coffees/' . $coffee->imageIce) }}"
                        class="img-fluid rounded" style="width: 90px; height: 90px; margin-right: 15px;"
                        alt="Espresso Double">
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
                          @if ($cartItem->type == 'coffee')
                          @foreach($coffees as $coffee)
                          @if($cartItem->product_id == $coffee->id)
                          @if ($cartItem->temperature == 'hot')
                          <span class="badge bg-danger">
                            Hot
                          </span>
                          @elseif ($cartItem->temperature == 'ice')
                          <span class="badge bg-info">
                            Ice
                          </span>
                          @endif
                          @endif
                          @endforeach
                          @else
                          <span class="badge bg-secondary">
                            Bean
                          </span>
                          @endif
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
                      <div class="align-items-center">
                        <button type="button" class="btn rounded btn-sm m-2" data-bs-toggle="modal"
                          data-bs-target="#productModal"
                          style="color: #ffffff; background-color: #3b2621; border: solid 1px #3b2621;">
                          <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm m-2"
                            onclick="return confirm('Are you sure you want to delete this item?')"
                            style="color: #3b2621; background-color: #fff7e8; border: solid 1px #3b2621;">
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
                @endif
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
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
              tabindex="0">
              {{-- CartItem with type bean --}}
              <ul class="list-group list-group-flush">
                @forelse($cartItems as $cartItem)
                @if ($cartItem->type == 'bean')
                <li class="list-group item">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      @foreach ( $beans as $bean )
                      @if ( $cartItem->product_id == $bean->id )
                      <img src="{{ asset('storage/img/products/beans/' . $bean->image) }}" class="img-fluid rounded"
                        style="width: 90px; height: 90px; margin-right: 15px;" alt="Espresso Double">
                      @endif
                      @endforeach
                      <div>
                        <h5 class="mb-1">
                          @foreach ( $beans as $bean )
                          @if ( $cartItem->product_id == $bean->id )
                          {{ $bean->name }}
                          @endif
                          @endforeach
                        </h5>
                        <div class="variants">
                          {{-- Badge --}}
                          <span class="badge bg-secondary">
                            {{ $cartItem->quantity }} x
                          </span>
                          {{-- Temperature --}}
                          <span class="badge bg-secondary">
                            Bean
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
                        <button type="button" class="btn rounded btn-sm m-2" data-bs-toggle="modal"
                          data-bs-target="#productModal"
                          style="color: #ffffff; background-color: #3b2621; border: solid 1px #3b2621;">
                          <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm m-2"
                            onclick="return confirm('Are you sure you want to delete this item?')"
                            style="color: #3b2621; background-color: #fff7e8; border: solid 1px #3b2621;">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </li>
                @endif
                @empty
                <li class="list-group item">
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
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
              tabindex="0">
              {{-- CartItem with type machine --}}
              <ul class="list-group list-group-flush">
                @forelse($cartItems as $cartItem)
                @if ($cartItem->type == 'machine')
                <li class="list-group item">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                      @foreach ( $machines as $machine )
                      @if ( $cartItem->product_id == $machine->id )
                      <img src="{{ asset('storage/img/products/machines/' . $machine->image) }}"
                        class="img-fluid rounded" style="width: 90px; height: 90px; margin-right: 15px;"
                        alt="Espresso Double">
                      @endif
                      @endforeach
                      <div>
                        <h5 class="mb-1">
                          @foreach ( $machines as $machine )
                          @if ( $cartItem->product_id == $machine->id )
                          {{ $machine->name }}
                          @endif
                          @endforeach
                        </h5>
                        <div class="variants">
                          {{-- Badge --}}
                          <span class="badge bg-secondary">
                            {{ $cartItem->quantity }} x
                          </span>
                          {{-- Temperature --}}
                          <span class="badge bg-secondary">
                            Machine
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
                        <button type="button" class="btn rounded btn-sm m-2" data-bs-toggle="modal"
                          data-bs-target="#productModal"
                          style="color: #ffffff; background-color: #3b2621; border: solid 1px #3b2621;">
                          <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm m-2"
                            onclick="return confirm('Are you sure you want to delete this item?')"
                            style="color: #3b2621; background-color: #fff7e8; border: solid 1px #3b2621;">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </li>
                @endif
                @empty
                <li class="list-group item">
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
        </div>
      </div>

      <!-- Pickup Detail -->
      <div class="col-md-4">
        <h3 class="card-title">
          <i class="bi bi-house-door"></i>
          Pickup Detail
        </h3>
        <hr>

        <form action="{{ route('orders.store') }}" method="POST">
          @csrf

          <div class="card rounded-4 shadow px-3 pt-4 pb-3" style="border: solid 2px #3b2621;">

            {{-- Product Type --}}
            @foreach ( $cartItems as $cartItem )
            @if ($cartItem->type == 'bean')
            <input type="hidden" name="type" value="bean">
            @elseif ($cartItem->type == 'machine')
            <input type="hidden" name="type" value="machine">
            @elseif ($cartItem->type == 'drink')
            <input type="hidden" name="type" value="drink">
            @endif
            @endforeach

            @foreach ( $cartItems as $cartItem )
            @if ($cartItem->type == 'bean' || $cartItem->type == 'machine')

            {{-- Destination Address --}}
            <div class="mb-3">
              <label for="destinationAddress" class="form-label">
                Full Address
              </label>
              <select class="form-select" id="destinationAddress" name="destinationAddress" required>
                <option selected>Choose Address</option>

                {{-- Check $addresses is NULL or NOT --}}
                @if ($addresses->count() == 0)
                <option value="0">No Address</option>
                @else
                @foreach ( $addresses as $address )
                <option value="{{ $address->address }}">{{ $address->address }}</option>
                @endforeach
                @endif

              </select>
            </div>

            {{-- Weight --}}
            <div class="mb-3">
              <label for="weight" class="form-label">
                Weight (Kg)
              </label>
              <input type="number" class="form-control" id="weight" name="weight" required
                value="{{ $cartItem->quantity }}">
            </div>
            @endif
            @endforeach

            <!-- Payment Method -->
            <div class="mb-3">
              <label for="paymentMethod" class="form-label">
                Payment Method
              </label>
              <select class="form-select" id="paymentMethod" name="paymentMethod">
                @if (($cartItem ?? false) && ($cartItem->type == 'bean' || $cartItem->type == 'machine'))
                <option value="transfer">Transfer</option>
                @elseif (($cartItem ?? false) && $cartItem->type == 'drink')
                <option value="cash">Cash (COD)</option>
                <option value="wallet">Gopay/DANA/QRIS</option>
                @endif
              </select>
            </div>

            {{-- Quantity --}}
            @php
            $totalQuantity = 0;
            foreach($cartItems as $cartItem) {
            $totalQuantity += $cartItem->quantity;
            }
            @endphp

            <!-- Payment Detail -->
            <div class="mb-3">
              <label class="form-label mb-0 fw-bold">
                Payment
              </label>
              <table class="table">
                @foreach ( $cartItems as $cartItem )
                @if ($cartItem->type == 'bean')
                <tr>
                  <td>Cost</td>
                  <td>:</td>
                  <td>
                    <span id="cost">Rp 5.000</span>
                    <input type="hidden" id="cost-input" name="cost" value="5000">
                  </td>
                </tr>
                @endif
                @endforeach
                <tr id="subtotal-row">
                  <td>Sub-total</td>
                  <td>:</td>
                  <td id="sub-total">Rp </td>
                  <input type="hidden" id="sub-total-input" name="subTotal" value="">
                </tr>
                @if ($hasDrink)
                <tr>
                  <td>Discount</td>
                  <td>:</td>
                  <td>
                    <span id="discount"></span>
                  </td>
                </tr>
                @endif
                <tr>
                  <td>Total</td>
                  <td>:</td>
                  <td>
                    <span id="total"></span>
                    <input type="hidden" id="total-input" name="total" value="">
                  </td>
                </tr>
              </table>
            </div>

            {{-- Coins --}}
            <div class="mb-3">
              <span>
                You have <span class="fw-bold">{{ auth()->user()->coin }}</span> coins
              </span>
              <label for="coins" class="form-label">
                Coins
              </label>
              <div class="row">
                <div class="col-8">
                  <input type="number" class="form-control" id="coins" name="coins">
                </div>
                <div class="col-4">
                  <button type="button" id="apply-coins-btn" class="btn col-6 btn-sm w-100"
                    style="background-color: #265526; color: white;">
                    Apply
                  </button>
                </div>
              </div>
            </div>

            <!-- Voucher -->
            @php
            $hasDrink = false;
            foreach ($cartItems as $cartItem) {
            if ($cartItem->type == 'drink') {
            $hasDrink = true;
            break;
            }
            }
            @endphp

            @if ($hasDrink)
            <div class="mb-3 row">
              <div class="col-8">
                <input type="text" class="form-control" id="voucher" name="voucherCode" placeholder="Voucher Code">
              </div>
              <div class="col-4">
                <button type="button" id="apply-voucher-btn" class="btn btn-sm w-100"
                  style="background-color: #265526; color: white;">
                  Apply
                </button>
              </div>
            </div>
            @endif

            <small class="text-muted mb-3">
              <i>
                *Can't use coins and voucher at the same time.
              </i>
            </small>

            <input type="hidden" name="note" value="{{ json_encode($cartItems->pluck('notes')) }}">
            <input type="hidden" name="quantity" value="{{ $totalQuantity }}">
            <input type="hidden" name="products" value="{{ json_encode($cartItems) }}">

            <!-- Personal Information -->
            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" hidden>
            <input type="phone" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" hidden>

            <!-- Checkout -->
            <div class="mb-3 mx-3">
              <div class="row">
                @php
                $types = $cartItems->pluck('type')->unique();
                @endphp
                @if ($types->count() > 1)
                {{-- ALert Waning --}}
                <div class="alert alert-warning" role="alert">
                  You can't order beans and drinks at the same time!
                </div>
                @else
                <button type="submit" class="btn btn-sm w-100 py-2" style="background-color: #265526; color: white;">
                  Order Now
                </button>
                @endif
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

  // If type is machine, remove cost and set total to sub-total
  let type = document.querySelector('input[name="type"]').value;
  if (type == 'machine') {

    // Hidden sub-total row element
    document.getElementById('subtotal-row').style.display = 'none';

    // Set total to sub-total
    document.getElementById('total').innerHTML = formattedTotalPrice;
    document.getElementById('total-input').value = totalPrice;
  } else {
    // Total = Sub-total + Cost ()
    let subTotal  = parseFloat(document.getElementById('sub-total-input').value);
    let cost      = parseFloat(document.getElementById('cost-input').value);
    let total     = subTotal + cost;

    // Format total price
    let formattedTotal = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    document.getElementById('total').innerHTML = formattedTotal;
  }

</script>

<script>
  document.getElementById('apply-voucher-btn').addEventListener('click', function() {
    let voucherCode = document.getElementById('voucher').value;
    let subTotal = parseFloat(document.getElementById('sub-total-input').value);

    // Ambil data voucher dari elemen HTML yang disiapkan di Controller
    let vouchers = @json($vouchers); // Data voucher dalam format JSON

    for (let i = 0; i < vouchers.length; i++) {
        if (voucherCode == vouchers[i].code) {

            // Check LIMIT Voucher
            if (vouchers[i].limit == 0) {
                alert('Voucher has reached its limit!');
                return;
            }

            // Hitung jumah order dari user yang memiliki kode voucher yang sama
            let orderCount = 0;
            @foreach($orders as $order)
            if ('{{ $order->voucherCode }}' == voucherCode) {
                orderCount += 1;
            }
            @endforeach

            // Jika ada lebih dari 2 order dengan kode voucher yang sama, maka voucher tidak bisa digunakan
            if (orderCount >= 2) {
                alert('You have reached the maximum usage of this voucher!');
                return;
            }

            // Check EXPIRED Voucher
            let expiredDate = new Date(vouchers[i].expired_at);
            let currentDate = new Date();
            if (currentDate > expiredDate) {
                alert('Voucher has expired!');
                return;
            }

            // Cek apakah ada coins yang dimasukkan
            if (document.getElementById('coins').value != '') {
                alert('You can\'t use coins and voucher at the same time!');
                return;
            } else {
                document.getElementById('apply-coins-btn').disabled = true;
            }

            let discount = parseFloat(vouchers[i].discount);
            let discountAmount = subTotal * (discount / 100);
            let total = subTotal - discountAmount;
            let formattedTotal = 'Rp ' + total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Place the discount amount with % format
            document.getElementById('discount').innerHTML = discount + '%' + ' (-Rp ' +
            discountAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ')';
            document.getElementById('total').innerHTML = formattedTotal;
            document.getElementById('total-input').value = total;

            this.disabled = true;
            return;
        }

        if (i == vouchers.length - 1) {
            alert('Voucher not found!');
        }
    }
    // Jika tidak ada voucher yang cocok, reset ke total awal
    document.getElementById('sub-total').innerHTML = formattedTotalPrice;
    document.getElementById('sub-total-input').value = totalPrice;
    document.getElementById('apply-voucher-btn').disabled = true;

});
</script>

<script>
  document.getElementById('apply-coins-btn').addEventListener('click', function() {
    let coins     = parseFloat(document.getElementById('coins').value);
    let subTotal  = parseFloat(document.getElementById('sub-total-input').value);
    let total     = parseFloat(document.getElementById('total-input').value);

    // Cek apakah koin yang dimasukkan lebih kecil atau sama dengan total koin user
    if (coins > {{ auth()->user()->coin }}) {
        alert('You don\'t have enough coins!');
        return;
    }

    // Jika tidak ada voucher yang dimasukan, maka masukan hasil dari penguangan koin ke total
    if (document.getElementById('discount').innerHTML == '') {
        let newTotal = subTotal - coins;
        document.getElementById('total').innerHTML = 'Rp ' + newTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        document.getElementById('total-input').value = newTotal;

        // Reset value input voucher
        document.getElementById('voucher').value = '';

    }

    // Jika ada voucher yang dimasukan
    if (document.getElementById('discount').innerHTML != '') {
        // Alert jika koin dan voucher tidak bisa digunakan bersamaan
        alert('You can\'t use coins and voucher at the same time!');
        // Reset value input voucher
        document.getElementById('discount').value = '';
        return;
    }

    this.disabled = true;

});
</script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

@endsection