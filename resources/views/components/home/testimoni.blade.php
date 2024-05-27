<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ulasan</h1>
        <!-- Carousel controls -->
        <div>
            <a class="btn btn-secondary rounded-circle" href="#testimonialCarousel" role="button" data-bs-slide="prev"
                style="background-color: #001804;">
                <i class="bi bi-arrow-left"></i>
            </a>
            <a class="btn btn-secondary rounded-circle" href="#testimonialCarousel" role="button" data-bs-slide="next"
                style="background-color: #001804;">
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <!-- Carousel -->
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- First set of testimonials -->
            <div class="carousel-item active">
                <div class="ulasan-box-container">
                    <!-- First four boxes -->
                    <!-- Repeat this structure for each box in the first set -->
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan1.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Sarah Putri</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i> <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Kopi di Feelectric selalu mencerahkan hariku dengan rasa yang kaya, lezat, dan
                            aroma yang memikat.</p>
                    </div>
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan2.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Adi Wijaya</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Kualitas kopi di Feelectric tidak pernah mengecewakan, selalu memberikan
                            kesegaran dan kepuasan pada setiap cangkirnya.</p>
                    </div>
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan3.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Maya Sari</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i> <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Feelectric adalah tempat favorit saya untuk minum kopi karena beragam pilihan
                            kopi mereka dan suasana yang nyaman.</p>
                    </div>
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan4.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Ahmad Ridwan</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i> <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Saya selalu kembali ke Feelectric untuk kopi mereka yang selalu membuat
                            pengalaman membeli kopi menjadi menyenangkan.</p>
                    </div>
                    <!-- Additional boxes for the first set here -->
                </div>
            </div>
            <!-- Second set of testimonials -->
            <div class="carousel-item">
                <div class="ulasan-box-container">
                    <!-- Boxes for the second set -->
                    <!-- Repeat this structure for each box in the second set -->
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan1.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Sarah Putri</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i> <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Kopi di Feelectric selalu mencerahkan hariku dengan rasa yang kaya, lezat, dan
                            aroma yang memikat.</p>
                    </div>
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan2.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Adi Wijaya</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Kualitas kopi di Feelectric tidak pernah mengecewakan, selalu memberikan
                            kesegaran dan kepuasan pada setiap cangkirnya.</p>
                    </div>
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan3.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Maya Sari</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i> <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Feelectric adalah tempat favorit saya untuk minum kopi karena beragam pilihan
                            kopi mereka dan suasana yang nyaman.</p>
                    </div>
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                <img src="{{ asset('frontend/img/testimonials/Ulasan4.png') }}" alt="User Name">
                            </div>
                            <div>
                                <strong>Ahmad Ridwan</strong>
                                <div class="reviews">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i> <!-- Half-filled star -->
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">Saya selalu kembali ke Feelectric untuk kopi mereka yang selalu membuat
                            pengalaman membeli kopi menjadi menyenangkan.</p>
                    </div>
                    <!-- Additional boxes for the second set here -->
                </div>
            </div>
        </div>
    </div>
</div>
