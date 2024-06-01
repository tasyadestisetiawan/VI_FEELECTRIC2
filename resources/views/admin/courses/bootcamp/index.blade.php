@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <button type="button" class="btn btn-sm btn-primary-theme float-end" data-bs-toggle="modal" data-bs-target="#createBootcampModal">
      Add Course
    </button>
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
                  <th>Name</th>
                  <th>Start</th>
                  <th>Location</th>
                  <th>Price</th>
                  <th>Kuota</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bootcamps as $bootcamp)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $bootcamp->name }}</td>
                  <td>{{ $bootcamp->start_date }}</td>
                  <td>{{ $bootcamp->location }}</td>
                  <td>
                    @if ($bootcamp->price == 0)
                    Free
                    @else
                    Rp. {{ number_format($bootcamp->price, 0, ',', '.') }}
                    @endif
                  </td>
                  <td>{{ $bootcamp->kuota }}</td>
                  <td>


                    <a href="{{ route('admin.bootcamps.show', $bootcamp->id) }}" class="btn btn-sm btn-detail-theme">
                      <i class="bi bi-info-circle"></i>
                    </a>

                    <!-- Edit -->
                    <button type="button" class="btn btn-sm btn-edit-theme" data-bs-toggle="modal" data-bs-target="#editBootcampModal{{ $bootcamp->id }}">
                      <i class="bi bi-pencil"></i>
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('admin.bootcamps.destroy', $bootcamp->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-delete-theme" onclick="return confirm('Are you sure?')">
                        <i class="bi bi-trash"></i>
                      </button>
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

{{-- Modal Create Course --}}
<div class="modal fade" id="createBootcampModal" tabindex="-1" aria-labelledby="createBootcampModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <form action="{{ route('admin.bootcamps.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header" style="background-color: #3B2621 !important;">
          <h5 class="modal-title text-light" id="createBootcampModalLabel">Add Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="kuota" class="form-label">Kuota</label>
                <input type="number" class="form-control" id="kuota" name="kuota" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-delete-theme" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-primary-theme">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Edit --}}
@foreach ($bootcamps as $bootcamp)
<div class="modal fade" id="editBootcampModal{{ $bootcamp->id }}" tabindex="-1" aria-labelledby="editBootcampModalLabel{{ $bootcamp->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <form action="{{ route('admin.bootcamps.update', $bootcamp->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header" style="background-color: #3B2621 !important;">
          <h5 class="modal-title text-light" id="editBootcampModalLabel{{ $bootcamp->id }}">Edit Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $bootcamp->name }}" required>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $bootcamp->start_date }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $bootcamp->end_date }}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="time" class="form-control" id="start_time" name="start_time" value="{{ $bootcamp->start_time }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="end_time" class="form-label">End Time</label>
                <input type="time" class="form-control" id="end_time" name="end_time" value="{{ $bootcamp->end_time }}" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $bootcamp->location }}" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $bootcamp->price }}" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="kuota" class="form-label">Kuota</label>
                <input type="number" class="form-control" id="kuota" name="kuota" value="{{ $bootcamp->kuota }}" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" required>{{ $bootcamp->description }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-delete-theme" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-primary-theme">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection