@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- <div class="col-md-12">
      <div class="header clearfix">
        <a href="#" class="btn btn-primary-theme btn-sm float-end mb-3" data-bs-toggle="modal"
          data-bs-target="#addSettingModal">Add Setting</a>
      </div>
    </div> --}}
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
                  <th>Value</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($settings as $setting)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $setting->name }}</td>
                  <td>{{ $setting->value }}</td>
                  <td>

                    {{-- Edit --}}
                    <button type="button" class="btn btn-edit-theme btn-sm" data-bs-toggle="modal"
                      data-bs-target="#editSettingModal{{ $setting->id }}">Edit</button>

                    {{-- Delete --}}
                    <form action="{{ route('admin.settings.destroy', $setting->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete-theme btn-sm"
                        onclick="return confirm('Are you sure you want to delete this setting?')">Delete</button>
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

{{-- Modal Edit --}}
@foreach ($settings as $setting)
<div class="modal fade" id="editSettingModal{{ $setting->id }}" tabindex="-1"
  aria-labelledby="editSettingModal{{ $setting->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Setting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $setting->name }}" required>
          </div>
          <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" class="form-control" id="value" name="value" value="{{ $setting->value }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

{{-- Modal Add --}}
<div class="modal fade" id="addSettingModal" tabindex="-1" aria-labelledby="addSettingModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Setting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.settings.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" class="form-control" id="value" name="value" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection