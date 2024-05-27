@extends('layouts.dashboard')

@section('content')
<div class="container">
  <div class="header clearfix">
    <a href="{{ route('admin.coffee-beans.index') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Kembali</a>
  </div>
  <div class="row">
    <div class="col-md-12">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      {{-- Form Create Product --}}
      <form action="{{ route('admin.coffee-beans.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
          <div class="col-4">
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="col-4">
            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" class="form-control" id="price" name="price" required>
            </div>
          </div>
          <div class="col-4">
            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-4">
            {{-- Origin --}}
            <div class="mb-3">
              <label for="origin" class="form-label">Origin</label>
              <input type="text" class="form-control" id="origin" name="origin" required>
            </div>
          </div>
          <div class="col-4">
            <div class="mb-3">
              <label for="image" class="form-label">Product Image</label>
              <input type="file" class="form-control" id="image" name="image" required>
            </div>
          </div>
          <div class="col-4">
            {{-- Weight --}}
            <div class="mb-3">
              <label for="weight" class="form-label">Weight</label>
              <input type="text" class="form-control" id="weight" name="weight" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-sm btn-primary">Save Product</button>

      </form>
    </div>
  </div>
</div>
@endsection