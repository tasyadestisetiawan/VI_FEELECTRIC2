<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Tentang Kami</h2>
            <p>Mari Mengenal <span>Kami</span></p>
        </div>

        <div class="row gy-4">
            <div class="col-lg-7 position-relative about-img"
                style="background-image: url({{ asset('frontend/img/about.jpg') }}) ;" data-aos="fade-up"
                data-aos-delay="150">
                <div class="call-us position-absolute rounded">
                    <h4>
                        Tanya Kami
                    </h4>
                    <p>
                        {{ $settings->phone }}
                    </p>
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                <div class="content ps-0 ps-lg-5">
                    <p class="fst-italic">
                        {{ $settings->site_description }}
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-all"></i>
                            Dari pada membuang waktu anda untuk mencari roti dan kue yang berkualitas, kami menyediakan berbagai macam roti dan kue dengan berbagai rasa
                        </li>
                        <li><i class="bi bi-check2-all"></i>
                            Produk roti dan kue kami sangat cocok untuk kebutuhan keluarga anda yang membutuhkan roti dan kue berkualitas.
                        </li>
                        <li><i class="bi bi-check2-all"></i> 
                            Diolah dari Gandum terbaik yang diolah dengan cara yang higienis dan sehat, menciptakan cita rasa sandwich yang lezat dan bergizi.
                        </li>
                    </ul>
                    <p>
                        Anda bisa mengikuti kami di sosial media kami untuk mendapatkan informasi terbaru dari kami atau menghubungi kami melalui kontak yang tersedia.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section><!-- End About Section -->
