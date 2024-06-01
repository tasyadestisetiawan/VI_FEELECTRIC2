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

            {{-- Form Create Product --}}
            <form id="productForm" action="{{ route('admin.products.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <option selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    value="hot" required>
                                <label class="form-check form-check-label" for="hot">Hot</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check form-check-input" type="radio" name="variant" id="ice"
                                    value="ice" required>
                                <label class="form-check form-check-label" for="ice">Ice</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check form-check-input" type="radio" name="variant" id="hot-ice"
                                    value="both" required>
                                <label class="form-check form-check-label" for="hot-ice">Hot & Ice</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Hot Variant (Stock, Price, Image) --}}
                <div class="row" id="hot-variant">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="supply" class="form-label">Stock</label>
                            <select class="form-select" id="supply" name="supply" required>
                                <option selected disabled>Select Stock</option>
                                <option value="1">Ready</option>
                                <option value="0">Empty</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="price_hot" class="form-label">Price Hot</label>
                            <input type="number" class="form-control" id="price_hot" name="priceHot" required>
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
                            <label for="supply" class="form-label">Stock</label>
                            <select class="form-select" id="supply" name="supply" required>
                                <option selected disabled>Select Stock</option>
                                <option value="1">Ready</option>
                                <option value="0">Empty</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="price_ice" class="form-label">Price Ice</label>
                            <input type="number" class="form-control" id="price_ice" name="priceIce" required>
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
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
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
                $('#supply, #price_hot, #image_hot').prop('required', true);
                $('#supply, #price_ice, #image_ice').prop('required', false);
            } else if (this.value == 'ice') {
                $('#hot-variant').hide();
                $('#ice-variant').show();
                $('#supply, #price_hot, #image_hot').prop('required', false);
                $('#supply, #price_ice, #image_ice').prop('required', true);
            } else {
                $('#hot-variant').show();
                $('#ice-variant').show();
                $('#supply, #price_hot, #image_hot').prop('required', true);
                $('#supply, #price_ice, #image_ice').prop('required', true);
            }
        });

        // Trigger change event on page load to set the initial state
        $('input[type=radio][name=variant]:checked').trigger('change');
    });
</script>

<script>
    document.getElementById('productForm').addEventListener('submit', function(event) {
        var variant = document.querySelector('input[name="variant"]:checked').value;
        var valid = true;

        if (variant === 'hot') {
            valid = validateHotVariant();
        } else if (variant === 'ice') {
            valid = validateIceVariant();
        } else {
            valid = validateHotVariant() && validateIceVariant();
        }

        if (!valid) {
            event.preventDefault();
            alert('Please fill in all required fields.');
        }
    });

    function validateHotVariant() {
        return document.getElementById('supply').checkValidity() &&
               document.getElementById('price_hot').checkValidity() &&
               document.getElementById('image_hot').checkValidity();
    }

    function validateIceVariant() {
        return document.getElementById('supply').checkValidity() &&
               document.getElementById('price_ice').checkValidity() &&
               document.getElementById('image_ice').checkValidity();
    }
</script>

@endsection