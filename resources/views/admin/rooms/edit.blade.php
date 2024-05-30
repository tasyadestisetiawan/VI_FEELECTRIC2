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
            {{-- Input Form Edit Room --}}
            <div class="col-12">
              <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="mb-3 col">
                    <label for="name" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}">
                  </div>
                  <div class="mb-3 col">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" class="form-control" id="capacity" name="capacity"
                      value="{{ $room->capacity }}">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $room->price }}">
                  </div>
                  <div class="mb-3 col">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                      <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                      <option value="unavailable" {{ $room->status == 'unavailable' ? 'selected' : '' }}>Not
                        Available</option>
                    </select>
                  </div>
                  <div class="mb-3 col">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="photo" value="{{ $room->photo }}">
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $room->description }}
                    </textarea>
                  </div>
                  <div class="mb-3 col">
                    <label for="facilities" class="form-label">Facilities</label>
                    <textarea class="form-control" id="facilities" name="facilities"
                      rows="3">{{ $room->facilities }} </textarea>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary-theme btn-sm">
                  Save Data Room
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection