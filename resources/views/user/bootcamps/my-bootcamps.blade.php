@extends('layouts.home')

<style>
  .input-group-text {
    border: 2px solid #3b2621 !important;
    background-color: #f8f9fa !important;
  }

  .form-control {
    border: 2px solid #3b2621 !important;
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
  <div class="header">
    <h1 class="text-start">
      My Bootcamps
    </h1>
    <p class="description">
      Don't forget to register for the bootcamp you want to attend.
    </p>
  </div>
  <div class="content">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      @forelse($mybootcamps as $data)
      <div class="col-md-4">
        <div class="card rounded-3 shadow-sm" style="border: solid 2px #3b2621;">
          <div class="m-3">
            @foreach ( $bootcamps as $bootcamp)
            @if($bootcamp->id == $data->bootcamp_id )
            <img src="{{ asset('storage/img/bootcamps/poster/' . $bootcamp->image) }}" class="card-img-top" alt="...">
            @endif
            @endforeach
          </div>
          <div class="card-body">
            <h5 class="card-title">
              @foreach ( $bootcamps as $bootcamp)
              @if($bootcamp->id == $data->bootcamp_id )
              {{ $bootcamp->name }}
              @endif
              @endforeach
            </h5>
            <p class="card-text">
              @foreach ( $bootcamps as $bootcamp)
              @if($bootcamp->id == $data->bootcamp_id )
              {{ $data->description }}
              @endif
              @endforeach
            </p>
            <div class="row mb-3">
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-calendar"></i>
                  {{ \Carbon\Carbon::parse($data->start_date)->format('d M Y') }}
                </span>
              </div>
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-clock"></i>
                  {{ \Carbon\Carbon::parse($data->start_time)->format('H:i') }} - {{
                  \Carbon\Carbon::parse($data->end_time)->format('H:i') }}
                </span>
              </div>
            </div>
            <div class="row mx-1">
              @if ($data->payment_status == 'unpaid')
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#updatePayment"
                style="background-color: #3b2621; color: white;">
                Update Payment
              </button>
              @elseif ($data->payment_status == 'pending')
              <span class="badge bg-warning py-2 text-dark">
                Your Registration is Pending
              </span>
              @elseif ($data->payment_status == 'paid')
              <a href="{{ route('bootcamps.show', $data->id) }}" class="btn"
                style="background-color: #3b2621; color: white;">
                View Details
              </a>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-md-12">
        <div class="card rounded-3 shadow-sm" style="border: solid 2px #3b2621;">
          <div class="card-body">
            <h5 class="card-title">
              You haven't registered for any bootcamps yet.
            </h5>
            <p class="card-text">
              Search for bootcamps that you want to attend and register now.
            </p>
          </div>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</div>

@foreach ($mybootcamps as $data)
{{-- Modal Update Payment --}}
<div class="modal fade" id="updatePayment" tabindex="-1" aria-labelledby="updatePaymentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="border: none;">
        <h5 class="modal-title" id="updatePaymentLabel">Update Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('bootcamps.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3 mx-3">
            <label for="payment_proof" class="form-label fw-bold">Payment Proof</label>
            <input type="file" class="form-control" id="payment_proof" name="payment_proof">
          </div>
        </div>
        <div class="modal-footer" style="border: none;">
          <button type="submit" class="btn" style="background-color: #3b2621; color: white;">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Bootcamp Detail --}}
<div class="modal fade" id="bootcampDetail{{ $data->id }}" tabindex="-1" aria-labelledby="bootcampDetailLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="border: none;">
        <h5 class="modal-title" id="bootcampDetailLabel">
          @foreach ( $bootcamps as $bootcamp)
          @if($bootcamp->id == $data->bootcamp_id )
          {{ $bootcamp->name }}
          @endif
          @endforeach
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-3">
        <div class="row">
          <div class="col-6">
            <img src="{{ asset('storage/img/bootcamps/poster/' . $bootcamp->image) }}" class="img-fluid" alt="...">
          </div>
          <div class="col-6">
            <h5 class="fw-bold">
              Description
            </h5>
            <p>
              @foreach ( $bootcamps as $bootcamp)
              @if($bootcamp->id == $data->bootcamp_id )
              {{ $data->description }}
              @endif
              @endforeach
            </p>
            <div class="row mb-3">
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-calendar"></i>
                  {{ \Carbon\Carbon::parse($data->start_date)->format('d M Y') }}
                </span>
              </div>
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-clock"></i>
                  {{ \Carbon\Carbon::parse($data->start_time)->format('H:i') }} - {{
                  \Carbon\Carbon::parse($data->end_time)->format('H:i') }}
                </span>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-geo-alt"></i>
                  @foreach ( $bootcamps as $bootcamp)
                  @if($bootcamp->id == $data->bootcamp_id )
                  {{ $bootcamp->location }}
                  @endif
                  @endforeach
                </span>
              </div>
              <div class="col-6">
                <span class="fw-bold">
                  <i class="bi bi-cash "></i>
                  {{ $data->price }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="border: none;">
        <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #3b2621; color: white;">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection