@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <button type="button" class="btn btn-sm btn-primary-theme float-end" data-bs-toggle="modal"
      data-bs-target="#addAdminModal">
      Add Admin
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
                  <th>Username</th>
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($admins as $admin)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $admin->name }}</td>
                  <td>
                    {{ $admin->username }}
                  </td>
                  <td>{{ $admin->email }}</td>
                  <td>

                    {{-- Edit --}}
                    <button type="button" class="btn btn-edit-theme btn-sm" data-bs-toggle="modal"
                      data-bs-target="#editModal{{ $admin->id }}">Edit</button>

                    {{-- Delete --}}
                    <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="d-inline">
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

{{-- Edit Modal --}}
@foreach ($admins as $admin)
<div class="modal fade" id="editModal{{ $admin->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $admin->id }}"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel{{ $admin->id }}">Edit Room</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.users.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $admin->username }}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>
          <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
          </div>
          <button type="submit" class="btn btn-primary-theme">Update Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

{{-- Modal Add ADmin --}}
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdminModalLabel">Add Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mb-3">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>
          <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
          </div>
          <button type="submit" class="btn btn-primary-theme">Save Data</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection