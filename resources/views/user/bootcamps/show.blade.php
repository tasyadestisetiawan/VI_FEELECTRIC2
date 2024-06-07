@extends('layouts.home')

<style>
  .table-borderless {
    background-color: transparent !important;
  }

  .table-borderless th,
  .table-borderless td {
    background-color: transparent !important;
  }

  .modal-dialog {
    background-color: #fff7e8 !important;
    border-radius: 10px !important;
  }

  input[type="text"] {
    background-color: #f8f9fa !important;
    border: solid 2px #3b2621 !important;
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-5">

    {{-- Alert Notifications --}}
    <x-alert type="success" :message="session('success')" />
    <x-alert type="danger" :errors="$errors->all()" />

    <h2 class="fw-bolder">
      {{ $bootcamp->name }}
    </h2>
    <div class="content mt-3">
      <div class="row">
        <div class="col-6">
          <img src="{{ asset('storage/img/bootcamps/poster/' . $bootcamp->image) }}" class="img-fluid" alt="...">
        </div>
        <div class="col-6">
          <table class="table table-borderless">
            <tbody>
              <tr>
                <td class="fw-bold" width="30%">
                  <i class="bi bi-people-fill"></i>
                  Quota
                </td>
                <td>
                  Remaining Quota for {{ $bootcamp->kuota }} participants
                </td>
              </tr>
              <tr>
                <td class="fw-bold">
                  <i class="bi bi-calendar"></i>
                  Date
                </td>
                <td>{{ $bootcamp->start_date }}</td>
              </tr>
              <tr>
                <td class="fw-bold">
                  <i class="bi bi-clock"></i>
                  Time
                </td>
                <td>{{ \Carbon\Carbon::parse($bootcamp->start_time)->format('H:i') }} - {{
                  \Carbon\Carbon::parse($bootcamp->end_time)->format('H:i') }}</td>
              </tr>
              <tr>
                <td colspan="2">
                  <p>{{ $bootcamp->description }}</p>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <h2 class="fw-bolder">
                    Rp. {{ number_format($bootcamp->price, 0, ',', '.') }}
                  </h2>
                </td>
              </tr>
            </tbody>
          </table>
          @if ($checkRegister)
          <div class="row mx-2">
            <button type="button" class="btn" disabled style="background-color: #3b2621; color: white;">
              You have registered this course
            </button>
          </div>
          @else
          <div class="row mx-2">
            {{-- Button Register --}}
            @if($bootcamp->kuota > 0)
            {{-- Modal Button --}}
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#registerModal"
              style="background-color: #3b2621; color: white;">
              Register Course Now
            </button>
            @else
            <button type="button" class="btn" disabled style="background-color: #3b2621; color: white;">
              Quota has been full, sorry!
            </button>
            @endif
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal Register --}}
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('user.bootcamps.register', $bootcamp->id) }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Register Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          <div class="row">
            <div class="col-6">
              <img src="{{ asset('storage/img/bootcamps/poster/' . $bootcamp->image) }}" class="img-fluid rounded-3"
                alt="...">
            </div>
            <div class="col-6">
              <h2>
                {{ $bootcamp->name }}
              </h2>
              <p>
                {{ $bootcamp->description }}
              </p>
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <td class="fw-bold">
                      <i class="bi bi-calendar"></i>
                      Date
                    </td>
                    <td>{{ $bootcamp->start_date }}</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">
                      <i class="bi bi-clock"></i>
                      Time
                    </td>
                    <td>{{ \Carbon\Carbon::parse($bootcamp->start_time)->format('H:i') }} - {{
                      \Carbon\Carbon::parse($bootcamp->end_time)->format('H:i') }}</td>
                  </tr>
              </table>
            </div>
          </div>

          {{-- Form --}}
          <div class="row">
            <div class="col-12">
              <div class="mb-3 mt-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row mx-2">
          <small>
            After you click the register button, please send the payment proof in my course page.
          </small>
        </div>
        {{-- Course ID --}}
        <input type="hidden" name="bootcamp_id" value="{{ $bootcamp->id }}">
        <div class="modal-footer">
          <button type="submit" class="btn" style="background-color: #3b2621; color: white;">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- <div class="container mt-4 mb-5">
  <h2 class="mb-3">Produk Terkait</h2>
  <div class="row row-cols-1 row-cols-md-3 g-4">
  </div>
</div> --}}

<!-- SweetALert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
  Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

@endsection