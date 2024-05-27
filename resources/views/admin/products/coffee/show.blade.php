@extends('layouts.dashboard')

@section('content')
<div class="container my-5 py-5">
  <div class="header clearfix">
    <h4 class="float-start my-2">{{ $title }}</h4>
    <a href="{{ route('admin.products.index') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Back to
      Products</a>
    <a href="{{ route('admin.products.edit', $product->id) }}"
      class="btn btn-edit-theme btn-sm float-end mb-3 me-3">Edit Product</a>
  </div>
  <div class="row">
    <div class="col-4">
      @if ($product->variant == 'hot')
      <img src="{{ asset('storage/img/products/coffees/' . $product->imageHot) }}" class="img-fluid"
        alt="{{ $product->name }}"
        style="width: 80%; height: 300px; object-fit: cover; border-radius: 10px; border: 2px solid #3B2621; padding: 5px; margin-bottom: 20px;">
      @elseif ($product->variant == 'ice')
      <img src="{{ asset('storage/img/products/coffees/' . $product->imageIce) }}" class="img-fluid"
        alt="{{ $product->name }}"
        style="width: 80%; height: 300px; object-fit: cover; border-radius: 10px; border: 2px solid #3B2621; padding: 5px; margin-bottom: 20px;">
      @else
      <div class="row">
        <div class="col-6">
          <img src="{{ asset('storage/img/products/coffees/' . $product->imageHot) }}" class="img-fluid"
            alt="{{ $product->name }}"
            style="width: 80%; height: 300px; object-fit: cover; border-radius: 10px; border: 2px solid #3B2621; padding: 5px; margin-bottom: 20px;">
        </div>
        <div class="col-6">
          <img src="{{ asset('storage/img/products/coffees/' . $product->imageIce) }}" class="img-fluid"
            alt="{{ $product->name }}"
            style="width: 80%; height: 300px; object-fit: cover; border-radius: 10px; border: 2px solid #3B2621; padding: 5px; margin-bottom: 20px;">
        </div>
      </div>
      @endif
    </div>
    <div class="col-8">
      <table class="table">
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Name</td>
          <td>{{ $product->name }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Category</td>
          <td>
            @foreach ($categories as $category)
            @if ($category->id == $product->category_id)
            {{ $category->name }}
            @endif
            @endforeach
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Variant</td>
          <td>{{ $product->variant }}</td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Stock</td>
          <td>
            @if ($product->stockHot == 0 && $product->stockIce == 0)
            <span class="text-danger">Out of Stock</span>
            @else
            @if($product->variant == 'hot')
            {{ $product->stockHot }} Hot
            @elseif($product->variant == 'ice')
            {{ $product->stockIce }} Ice
            @else
            {{ $product->stockHot }} Hot, {{ $product->stockIce }} Ice
            @endif
            @endif
          </td>
        </tr>
        <tr style="border-bottom: 1px solid #3B2621;">
          <td class="fw-bold">Price</td>
          <td>
            @if($product->variant == 'hot')
            Rp {{ number_format($product->priceHot, 0, ',', '.') }}
            @elseif($product->variant == 'ice')
            Rp {{ number_format($product->priceIce, 0, ',', '.') }}
            @else
            Rp {{ number_format($product->priceHot, 0, ',', '.') }} Hot, Rp {{ number_format($product->priceIce, 0, ',',
            '.') }} Ice
            @endif
          </td>
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