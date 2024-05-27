@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <h2 class="float-start">Category</h2>
    <button type="button" class="btn btn-sm btn-primary-theme float-end" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
  </div>

  <div class="card shadow mb-4 mt-3">
    <div class="card-body">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      {{-- Table Category --}}
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->created_at }}</td>
              <td>{{ $category->updated_at }}</td>
              <td>
                <button type="button" class="btn btn-edit-theme btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">Edit</button>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete-theme btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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

{{-- Edit Modal --}}
@foreach ($categories as $category)
<div class="modal fade editCategoryModal" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body px-4">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-delete-theme btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary-theme btn-sm">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

{{-- Modal Add Category --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="modal-body px-4">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-delete-theme btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary-theme btn-sm">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection