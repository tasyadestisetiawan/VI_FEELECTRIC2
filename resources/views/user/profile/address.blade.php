@extends('layouts.home')

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <div class="row">

        <div class="col-5">
          <x-profile />
        </div>

        <div class="col-7">
          <div class="card rounded-4 shadow-sm w-100" style="border: solid 1px #3b2621;">
            <div class="card-header bg-white border-0 mt-2">
              <ul class="nav nav-pills gap-3">
                <li class="nav-item">
                  <a class="nav-link active rounded-pill" style="background-color: #fff7e8;  color: #3b2621;"
                    href="{{route('user.profile')}}">
                    Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('orders.index')}}">
                    Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{ route('user.reservations.my') }}">
                    Reservations
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #3b2621; color: #fff7e8"
                    href="{{route('user.address')}}">Address</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link rounded-pill border-2" style="background-color: #fff7e8; color: #3b2621"
                    href="{{route('vouchers.index')}}">Vouchers</a>
                </li>
              </ul>
            </div>
            <div class="card-body mx-2">
              <div class="row">
                <div class="col-12">
                  <h5 class="fw-bold">Address</h5>
                  <p>
                    Manage your address here.
                  </p>
                </div>

                @forelse($data as $item)
                <div class="card rounded-4 mx-2 pt-2">
                  <div class="card-body">
                    <h6 class="card-title">
                      <!-- Radio Checked -->
                      <input type="radio" name="address" id="address" checked>
                      Address <span class="badge rounded bg-success">
                        {{ $item->type }}
                      </span>
                    </h6>
                    <p>
                      {{ $item->address }}
                    </p>
                    <!-- Edit Button -->
                    <button type="button" class="btn rounded-4" style="background-color: #3b2621; color: #fff7e8;"
                      data-bs-toggle="modal" data-bs-target="#updateAddress{{ $item->id }}">
                      Edit
                    </button>
                  </div>
                </div>
                @empty
                <p>No addresses found.</p>
                @endforelse

                <div class="row mt-3">
                  <div class="col-12">
                    <button type="button" class="btn rounded-4" style="background-color: #3b2621; color: #fff7e8;"
                      data-bs-toggle="modal" data-bs-target="#newAddress">
                      Add New Address
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal New Address -->
<div class="modal fade" id="newAddress" tabindex="-1" aria-labelledby="newAddressLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newAddressLabel">New Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-2">
        <form action="{{ route('user.address.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
              <option selected disabled>Select Type</option>
              <option value="Home">Home</option>
              <option value="Office">Office</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <button type="submit" class="btn rounded-4" style="background-color: #3b2621; color: #fff7e8;">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal Update --}}
@foreach($data as $item)
<div class="modal fade" id="updateAddress{{ $item->id }}" tabindex="-1"
  aria-labelledby="updateAddressLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateAddressLabel{{ $item->id }}">Update Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-2">
        <form action="{{ route('user.address.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $item->address }}" required>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
              <option selected disabled>Select Type</option>
              <option value="Home" {{ $item->type == 'Home' ? 'selected' : '' }}>Home</option>
              <option value="Office" {{ $item->type == 'Office' ? 'selected' : '' }}>Office</option>
              <option value="Other" {{ $item->type == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>
          <button type="submit" class="btn rounded-4" style="background-color: #3b2621; color: #fff7e8;">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection