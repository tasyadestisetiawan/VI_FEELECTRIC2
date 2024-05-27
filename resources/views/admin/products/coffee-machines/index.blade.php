@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="header clearfix">
            <a href="{{ route('admin.coffee-machines.create') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Add Product</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('storage/img/products/machines/' . $product->image) }}"
                                                    alt="" class="img-fluid" width="100">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                              {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.coffee-machines.show', $product->id) }}"
                                                    class="btn btn-sm btn-detail-theme">Detail</a>
                                                <a href="{{ route('admin.coffee-machines.edit', $product->id) }}"
                                                    class="btn btn-sm btn-edit-theme">Edit</a>
                                                <form action="{{ route('admin.coffee-machines.destroy', $product->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-delete-theme">Delete</button>
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
