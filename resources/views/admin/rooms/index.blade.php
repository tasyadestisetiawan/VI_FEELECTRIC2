@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Add Room</a>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          {{-- Alert Notifications --}}
          <x-alert type="success" :message="session('success')" />
          <x-alert type="danger" :errors="$errors->all()" />

          <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Room</th>
                  <th>Capacity</th>
                  <th>Price</th>
                  <th>Room Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rooms as $room)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $room->name }}</td>
                  <td>{{ $room->capacity }} Person</td>
                  <td>
                    Rp. {{ number_format($room->price, 0, ',', '.') }}
                  </td>
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
                  <td>
                    {{-- Detail --}}
                    <a href="{{ route('admin.rooms.show', $room->id) }}" class="btn btn-detail-theme btn-sm">Detail</a>

                    {{-- Edit --}}
                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-edit-theme btn-sm">Edit</a>

                    {{-- Delete --}}
                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete-theme btn-sm"
                        onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection