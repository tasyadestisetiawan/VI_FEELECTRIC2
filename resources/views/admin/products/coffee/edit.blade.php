@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="header clearfix">
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary-theme btn-sm float-end mb-3">Kembali</a>
    </div>
    <div class="row">
        <div class="col-md-12">

            {{-- Alert --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form Edit Product --}}
            <form id="productForm" action="{{ route('admin.products.update', $product->id) }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}"
                                required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ?
                                    'selected' : '' }}>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Variant --}}
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="variant" class="form-label">Variant</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check form-check-input" type="radio" name="variant" id="hot"
                                    value="hot" {{ $product->variant == 'hot' ? 'checked' : '' }}>
                                <label class="form-check-label" for="hot">Hot</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check form-check-input" type="radio" name="variant" id="ice"
                                    value="ice" {{ $product->variant == 'ice' ? 'checked' : '' }}>
                                <label class="form-check-label" for="ice">Ice</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check form-check-input" type="radio" name="variant" id="both"
                                    value="both" {{ $product->variant == 'both' ? 'checked' : '' }}>
                                <label class="form-check-label" for="both">Both</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hot Variant (Stock, Price, Image) --}}
                <div class="row" id="hot-variant">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="supply_hot" class="form-label">Supply Hot</label>
                            <select class="form-select" id="supply_hot" name="supply_hot" required>
                                <option value="">Select Stock</option>
                                <option value="1" {{ $product->supply_hot == 1 ? 'selected' : '' }}>Ready</option>
                                <option value="0" {{ $product->supply_hot == 0 ? 'selected' : '' }}>Empty</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="price_hot" class="form-label">Price Hot</label>
                            <input type="number" class="form-control" id="price_hot" name="priceHot" required
                                value="{{ $product->priceHot }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="image_hot" class="form-label">Image Hot</label>
                            <input type="file" class="form-control" id="image_hot" name="imageHot" required>
                        </div>
                    </div>
                </div>

                {{-- Ice Variant (Stock, Price, Image) --}}
                <div class="row" id="ice-variant">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="supply_ice" class="form-label">Supply Ice</label>
                            <select class="form-select" id="supply_ice" name="supply_ice" required>
                                <option value="">Select Stock</option>
                                <option value="1" {{ $product->supply_ice == 1 ? 'selected' : '' }}>Ready</option>
                                <option value="0" {{ $product->supply_ice == 0 ? 'selected' : '' }}>Empty</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="price_ice" class="form-label">Price Ice</label>
                            <input type="number" class="form-control" id="price_ice" name="priceIce" required
                                value="{{ $product->priceIce }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="image_ice" class="form-label">Image Ice</label>
                            <input type="file" class="form-control" id="image_ice" name="imageIce" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"
                        required>{{ $product->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-sm btn-primary">Save Product</button>
            </form>
        </div>
    </div>
</div>

{{-- JQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Show/Hide Variant
    $(document).ready(function() {
        $('#hot-variant').hide();
        $('#ice-variant').hide();

        $('input[type=radio][name=variant]').change(function() {
            if (this.value == 'hot') {
                $('#hot-variant').show();
                $('#ice-variant').hide();
                $('#supply_hot, #price_hot, #image_hot').prop('required', true);
                $('#supply_ice, #price_ice, #image_ice').prop('required', false);
            } else if (this.value == 'ice') {
                $('#hot-variant').hide();
                $('#ice-variant').show();
                $('#supply_hot, #price_hot, #image_hot').prop('required', false);
                $('#supply_ice, #price_ice, #image_ice').prop('required', true);
            } else if (this.value == 'both') {
                $('#hot-variant').show();
                $('#ice-variant').show();
                $('#supply_hot, #price_hot, #image_hot, #supply_ice, #price_ice, #image_ice').prop('required', true);
            }
        });

        // Trigger change event on page load to set the initial state
        $('input[type=radio][name=variant]:checked').trigger('change');
    });
</script>

@endsection