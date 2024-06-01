@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <h2 class="float-start">
      Quiz Management
    </h2>
    <button type="button" class="btn btn-sm btn-primary-theme float-end" data-bs-toggle="modal"
      data-bs-target="#addCategoryModal">Add Quiz</button>
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
              <th>Title</th>
              <th>Reward</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($quizzes as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->title }}</td>
              <td>
                <i class="bi bi-coin"></i> {{ number_format($data->coins, 0, ',', '.') }} Coins
              </td>
              <td>
                <a href="{{ route('admin.quizzes.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.quizzes.destroy', $data->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
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

{{-- Modal Add Quiz --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add Quiz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.quizzes.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="mb-3">
            <label for="coins" class="form-label">Reward</label>
            <input type="number" class="form-control" id="coins" name="coins" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection