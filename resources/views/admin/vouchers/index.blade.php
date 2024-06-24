@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-6">
              <h4 class="text-muted">
                Manage all Vouchers in one place, you can also add, edit and delete Vouchers.
              </h4>
            </div>
            <div class="col-6">
              {{-- Button Add --}}
              <button type="button" class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
                <i class="bi bi-plus-lg"></i>
                Add Voucher
              </button>
            </div>
          </div>
        </div>

        {{-- Notification --}}
        <x-alert type="success" :message="session('success')" />
        <x-alert type="danger" :errors="$errors->all()" />

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Discount</th>
                  <th>Limit</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($vouchers as $voucher)
                <tr>
                  <td>{{ $voucher->id }}</td>
                  <td>{{ $voucher->name }}</td>
                  <td>{{ $voucher->code }}</td>
                  <td>{{ $voucher->discount }}</td>
                  <td>{{ $voucher->limit }}</td>
                  <td>
                    {{-- Button Edit --}}
                    <button type="button" class="btn btn-edit-theme btn-sm" data-bs-toggle="modal" data-bs-target="#editVoucherModal{{ $voucher->id }}">
                      Edit
                    </button>
                    {{-- Button Delete --}}
                    <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete-theme btn-sm">Delete</button>
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

{{-- Modal Add Voucher --}}
<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addVoucherModalLabel">Add Voucher</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <form action="{{ route('admin.vouchers.store') }}" method="POST">
          @csrf
          {{-- Name --}}
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          {{-- Code --}}
          <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
          </div>
          {{-- Limit --}}
          <div class="mb-3">
            <label for="limit" class="form-label">Limit</label>
            <input type="number" class="form-control" id="limit" name="limit" required>
          </div>
          {{-- Discount --}}
          <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" class="form-control" id="discount" name="discount" required>
          </div>
          {{-- Expired --}}
          <div class="mb-3">
            <label for="expired" class="form-label">Expired</label>
            <input type="date" class="form-control" id="expired" name="expired_at">
          </div>
          <button type="submit" class="btn btn-sm rounded-3 btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- Modal Edit Voucher --}}
@foreach ($vouchers as $voucher)
<div class="modal fade" id="editVoucherModal{{ $voucher->id }}" tabindex="-1" aria-labelledby="editVoucherModalLabel{{ $voucher->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editVoucherModalLabel{{ $voucher->id }}">Edit Voucher</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-start">
        <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST">
          @csrf
          @method('PUT')
          {{-- Name --}}
          <div class="mb-3">
            <label for="name{{ $voucher->id }}" class="form-label">Name</label>
            <input type="text" class="form-control" id="name{{ $voucher->id }}" name="name" value="{{ $voucher->name }}" required>
          </div>
          {{-- Code --}}
          <div class="mb-3">
            <label for="code{{ $voucher->id }}" class="form-label">Code</label>
            <input type="text" class="form-control" id="code{{ $voucher->id }}" name="code" value="{{ $voucher->code }}" required>
          </div>
          {{-- Limit --}}
          <div class="mb-3">
            <label for="limit{{ $voucher->id }}" class="form-label">Limit</label>
            <input type="number" class="form-control" id="limit{{ $voucher->id }}" name="limit" value="{{ $voucher->limit }}" required>
          </div>
          {{-- Discount --}}
          <div class="mb-3">
            <label for="discount{{ $voucher->id }}" class="form-label">Discount</label>
            <input type="number" class="form-control" id="discount{{ $voucher->id }}" name="discount" value="{{ $voucher->discount }}" required>
          </div>
          {{-- Expired --}}
          <div class="mb-3">
            <label for="expired{{ $voucher->id }}" class="form-label">Expired</label>
            <input type="date" class="form-control" id="expired{{ $voucher->id }}" name="expired_at" value="{{ $voucher->expired_at }}" required>
          </div>
          <button type="submit" class="btn btn-sm rounded-3 btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach


@endsection