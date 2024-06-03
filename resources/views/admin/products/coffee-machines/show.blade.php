@extends('layouts.dashboard')

@section('content')
<div class="container my-5 py-5">
    <div class="header clearfix">
        <h4 class="float-start my-2">{{ $title }}</h4>
        <a href="{{ route('admin.coffee-machines.index') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Back to
            Products</a>
        {{-- Edit Button --}}
        <a href="{{ route('admin.coffee-machines.edit', $product->id) }}"
            class="btn btn-edit-theme btn-sm float-end mb-3 me-3">Edit
            Product</a>
    </div>
    <div class="row">
        <div class="col-4">
            {{-- Product Image --}}
            <img src="{{ asset('storage/img/products/machines/' . $product->image) }}" class="img-fluid"
                alt="{{ $product->name }}"
                style="width: 80%; height: 300px; object-fit: cover; border-radius: 10px; border: 2px solid #3B2621; padding: 5px; margin-bottom: 20px;">
        </div>
        <div class="col-8">
            <table class="table">
                <tr style="border-bottom: 1px solid #3B2621;">
                    <td class="fw-bold">Name</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #3B2621;">
                    <td class="fw-bold">Price</td>
                    <td>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                </tr>
                <tr style="border-bottom: 1px solid #3B2621;">
                    <td class="fw-bold">Stock</td>
                    <td>{{ $product->stock }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #3B2621;">
                    <td class="fw-bold">Description</td>
                    <td>{{ $product->description }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection