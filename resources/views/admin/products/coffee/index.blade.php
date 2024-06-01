@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <div class="header clearfix">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Add Product</a>
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
                  <th>Image</th>
                  <th>Name</th>
                  <th>Variant</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    @if($product->variant == 'hot')
                    <img src="{{ asset('storage/img/products/coffees/' . $product->imageHot) }}"
                      alt="{{ $product->name }}" width="50">
                    @elseif($product->variant == 'ice')
                    <img src="{{ asset('storage/img/products/coffees/' . $product->imageIce) }}"
                      alt="{{ $product->name }}" width="50">
                    @else
                    <img src="{{ asset('storage/img/products/coffees/' . $product->imageIce) }}"
                      alt="{{ $product->name }}" width="50">
                    @endif
                  </td>
                  <td>{{ $product->name }}</td>
                  <td>
                    @if($product->variant == 'hot')
                    <span class="badge bg-danger">Hot</span>
                    @elseif($product->variant == 'ice')
                    <span class="badge bg-primary">Ice</span>
                    @else
                    <span class="badge bg-success">Hot & Ice</span>
                    @endif
                  </td>
                  <td>
                    @if($product->variant == 'hot')
                    Rp {{ number_format($product->priceHot, 0, ',', '.') }}
                    @elseif($product->variant == 'ice')
                    Rp {{ number_format($product->priceIce, 0, ',', '.') }}
                    @else
                    Rp {{ number_format($product->priceHot, 0, ',', '.') }} - Rp {{ number_format($product->priceIce, 0,
                    ',', '.') }}
                    @endif
                  </td>
                  <td>
                    @if($product->supply == 1 )
                    <span class="badge bg-success">Ready</span>
                    @elseif($product->supply == 0 )
                    <span class="badge bg-danger">Empty</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-detail-theme">
                      <i class="bi bi-info-circle"></i>
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-edit-theme">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete-theme btn-sm"
                        onclick="return confirm('Are you sure you want to delete this product?')">
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
@endsection