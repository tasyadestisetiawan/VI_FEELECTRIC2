@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Add Feedback</a>
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
                  <th>Messages</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($feedbacks as $testimonial)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $testimonial->name }}</td>
                  <td>{{ $testimonial->message }} Person</td>
                  <td>

                    {{-- Edit --}}
                    <a href="{{ route('admin.feedbacks.edit', $testimonial->id) }}"
                      class="btn btn-edit-theme btn-sm">Edit</a>

                    {{-- Delete --}}
                    <form action="{{ route('admin.feedbacks.destroy', $testimonial->id) }}" method="POST"
                      class="d-inline">
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