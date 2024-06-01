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
            <div class="carousel-item active">
                <div class="ulasan-box-container">
                    @foreach ($testimonials as $testimonial)
                    <div class="ulasan-box">
                        <div class="profile">
                            <div class="profile-img p-2">
                                @foreach ($users as $user)
                                @if ($user->id == $testimonial->user_id)
                                @if ($user->avatar == null)
                                <img src="https://sm.ign.com/ign_nordic/cover/a/avatar-gen/avatar-generations_prsz.jpg"
                                    alt="profile-img">
                                @else
                                <img src="{{ asset('storage/img/avatars/' . $user->avatar) }}">
                                @endif
                                @endif
                                @endforeach
                            </div>
                            <div>
                                <strong>
                                    {{ $testimonial->name }}
                                </strong>
                                <div class="reviews">
                                    @for ($i = 0; $i < $testimonial->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        <p class="lh-1">
                            {{ $testimonial->message }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>