@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Back</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          {{-- Alert Notifications --}}
          <x-alert type="success" :message="session('success')" />
          <x-alert type="danger" :errors="$errors->all()" />

          <div class="row">
            <div class="col-6">
              <image src="{{ asset('storage/img/rooms/' . $room->photo) }}" class="img-fluid rounded"
                alt="{{ $room->name }}">
            </div>

            <div class="col-6">
              <table class="table table-striped table-hover">
                <tr>
                  <th>Room</th>
                  <td>{{ $room->name }}</td>
                </tr>
                <tr>
                  <th>Capacity</th>
                  <td>{{ $room->capacity }} Person</td>
                </tr>
                <tr>
                  <th>Price</th>
                  <td>Rp. {{ number_format($room->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                  <th>Room Status</th>
                  <td>
                    @if ($room->status == 'available')
                    <span class="badge bg-success">
                      AVAILABLE
                    </span>
                    @else
                    <span class="badge bg-danger">
                      NOT AVAILABLE
                    </span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Facilities</th>
                  <td>{{ $room->facilities }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $room->description }}</td>
                </tr>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection