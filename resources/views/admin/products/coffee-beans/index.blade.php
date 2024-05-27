@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="header clearfix">
        <a href="{{ route('admin.coffee-beans.create') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Add Product</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <x-alert type="success" :message="session('success')" />
                    <x-alert type="danger" :errors="$errors->all()" />
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Weight</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coffeeBeans as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/img/products/beans/' . $product->image) }}" alt="" class="img-fluid" width="100">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->weight }}</td>
                                    <td>
                                        <a href="{{ route('admin.coffee-beans.show', $product->id) }}" class="btn btn-sm btn-detail-theme">Detail</a>
                                        <a href="{{ route('admin.coffee-beans.edit', $product->id) }}" class="btn btn-sm btn-edit-theme">Edit</a>
                                        <form action="{{ route('admin.coffee-beans.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete-theme">Delete</button>
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