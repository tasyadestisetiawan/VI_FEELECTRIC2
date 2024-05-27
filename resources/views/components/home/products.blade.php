<!-- ======= Menu Section ======= -->
<section id="products" class="menu">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>
                Produk Kami
            </h2>
            <p>
                Pilihan <span>Roti dan Kue</span> Aneka Rasa
            </p>
        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
            <div class="tab-pane fade active show" id="menu-starters">
                <div class="row gy-5">
                    @foreach($products as $product)
                    <div class="col-lg-4 menu-item card p-4 rounded border-0 shadow-sm">
                        <a href="{{ asset('storage/products/' . $product->photo) }}" class="glightbox"><img
                                src="{{ asset('storage/products/' . $product->photo) }}" class="menu-img img-fluid" alt=""></a>
                        <h4>
                            {{ $product->name }}
                        </h4>
                        <p class="ingredients">
                            @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                {{ $category->name }}
                                @endif
                            @endforeach
                        </p>
                        <p class="price">
                            {{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div><!-- End Starter Menu Content -->
        </div>
    </div>
</section><!-- End Menu Section -->
