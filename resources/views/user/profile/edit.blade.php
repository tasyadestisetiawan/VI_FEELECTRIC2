@extends('layouts.home')

<style>
  input {
    border: solid 2px #3b2621 !important;
  }

  textarea {
    border: solid 2px #3b2621 !important;
  }
</style>

@section('content')
<div class="container my-5 py-5">
  <div class="row mt-4">
    <div class="row">

      {{-- Alert Notifications --}}
      <x-alert type="success" :message="session('success')" />
      <x-alert type="danger" :errors="$errors->all()" />

      <div class="row">
        <div class="col-12">
          <div class="card rounded-4 p-3 shadow-sm w-100" style="border: solid 2px #3b2621;">
            <div class="card-body mx-2">
              <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                  <!-- Image -->
                  <div class="col-3">
                    <img src="{{ asset('storage/img/avatars/' . Auth::user()->avatar) }}" class="img-fluid rounded-4"
                      alt="..." style="width: 200px; border: solid 2px #3b2621;">

                    <!-- Input Image -->
                    <div class="form-group mt-1" style="width: 200px;">
                      <input type="file" class="form-control" id="image" name="avatar"
                        style="border: solid 2px #3b2621; width: 200px;">
                      <small class="mt-4">
                        <i class="fas fa-info-circle"></i> File type: jpg, jpeg, png. Max size: 2MB
                      </small>
                    </div>
                  </div>
                  <!-- Biodata -->
                  <div class="col-9">
                    <h5 class="card-title">
                      Update Biodata
                    </h5>

                    <!-- Name -->
                    <div class="form-group mb-2">
                      <label for="name">Name</label>
                      <input type="text" class="form-control mt-1" id="name" name="name"
                        value="{{ Auth::user()->name }}">
                    </div>

                    <!-- Address -->
                    <div class="form-group mb-2">
                      <label for="address">Address</label>
                      <textarea class="form-control mt-1" id="address" name="address"
                        rows="3">{{ Auth::user()->address }}</textarea>
                    </div>

                    <h5 class="card-title">
                      Contacts
                    </h5>

                    <!-- Phone -->
                    <div class="form-group mb-2">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control mt-1" id="phone" name="phone"
                        value="{{ Auth::user()->phone }}">
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-2">
                      <label for="email">Email</label>
                      <input type="email" class="form-control mt-1" id="email" name="email"
                        value="{{ Auth::user()->email }}">
                    </div>

                    <div class="mt-3">
                      <div class="row g-2">
                        <div class="col-6">
                          <button type="submit" class="btn btn-primary w-100"
                            style="background-color: #3b2621; border-color: #3b2621;">Update</button>
                        </div>
                        <div class="col-6">
                          <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary w-100"
                            style="color: #3b2621;">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection