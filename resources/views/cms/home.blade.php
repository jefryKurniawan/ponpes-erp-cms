@extends('layouts.cms')

@section("title", "Beranda | {{ $settings?->nama_pesantren ?? 'Pesantren' }}")
@section("description", "{{ $settings?->isi ?? 'Pesantren CMS - Sistem Manajemen Pesantren Modern' }}")
@section("og_title", "{{ $settings?->nama_pesantren ?? 'Pesantren' }}")
@section("og_description", "{{ $settings?->isi ?? 'Pesantren CMS - Sistem Manajemen Pesantren Modern' }}")
@section('og_image', asset('assets/img/og-image.jpg'))
@section("twitter_title", "{{ $settings?->nama_pesantren ?? 'Pesantren' }}")
@section("twitter_description", "{{ $settings?->isi ?? 'Pesantren CMS - Sistem Manajemen Pesantren Modern' }}")
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
<!-- Hero Section -->
<section class="hero-section position-overflow-hidden">
    <div class="hero-bg">
        <!-- Geometric pattern overlay -->
        <div class="geometric-pattern-overlay"></div>
    </div>
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Asymmetric layout: content takes more space on left -->
            <div class="col-lg-7">
                <div class="hero-content">
                    <h1 class="hero-title display-4">
                        Selamat Datang di Pesantren {{ $settings?->nama_pesantren ?? 'Nama Pesantren' }}
                    </h1>
                    <p class="hero-subtitle lead">
                        Lembaga pendidikan Islam yang berkomitmen pada kecemerlangan akademik dan pembentukan karakter berdasarkan nilai-nilai keslaman.
                    </p>
                    <div class="hero-actions mt-4">
                        <a href="{{ route('cms.psb') }}" class="btn btn-primary btn-lg me-3 mb-2">
                            Pendaftaran Santri Baru
                        </a>
                        <a href="{{ route('cms.gallery') }}" class="btn btn-outline-light btn-lg mb-2 me-2">
                            Lihat Galeri
                        </a>
                        <a href="{{ route('cms.about') }}" class="btn btn-outline-light btn-lg mb-2">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
            <!-- Image section takes less space for asymmetric effect -->
            <div class="col-lg-5">
                <div class="hero-image-container position-relative">
                    <!-- Slideshow container -->
                    <div class="hero-slideshow hover-lift decorative-border">
                        <div class="slides">
                            <!-- Slide 1 -->
                            <div class="slide active">
                                <img src="https://via.placeholder.com/600x400?text=Kegiatan+Hafalan+dan+Tilawah" alt="Kegiatan Hafalan dan Tilawah" class="img-fluid rounded">
                            </div>
                            <!-- Slide 2 -->
                            <div class="slide">
                                <img src="https://via.placeholder.com/600x400?text=Upacara+Peringatan+Hari+ Besar+Islam" alt="Upacara Peringatan Hari Besar Islam" class="img-fluid rounded">
                            </div>
                            <!-- Slide 3 -->
                            <div class="slide">
                                <img src="https://via.placeholder.com/600x400?text=Kelas+Santri+dalam+Aktifitas+Belajar" alt="Kelas Santri dalam Aktifitas Belajar" class="img-fluid rounded">
                            </div>
                            <!-- Slide 4 -->
                            <div class="slide">
                                <img src="https://via.placeholder.com/600x400?text=Kegiatan+Ekstrakurikuler+Pramuka" alt="Kegiatan Ekstrakurikuler Pramuka" class="img-fluid rounded">
                            </div>
                            <!-- Slide 5 -->
                            <div class="slide">
                                <img src="https://via.placeholder.com/600x400?text=Moment+Kehidupan+Santri+di+Pondok" alt="Moment Kehidupan Santri di Pondok" class="img-fluid rounded">
                            </div>
                        </div>
                        <!-- Slideshow navigation -->
                        <div class="slider-nav">
                            <span class="nav-dot active" data-slide="0"></span>
                            <span class="nav-dot" data-slide="1"></span>
                            <span class="nav-dot" data-slide="2"></span>
                            <span class="nav-dot" data-slide="3"></span>
                            <span class="nav-dot" data-slide="4"></span>
                        </div>
                    </div>
                    <!-- Organic decorative element -->
                    <div class="hero-decoration position-absolute top-0 start-50 translate-middle-x">
                        <div class="organic-shape"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section with enhanced visual hierarchy -->
<section class="stats-section py-5 position-relative">
    <div class="container">
        <div class="row text-center g-4">
            <!-- Stat 1 -->
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift decorative-border">
                    <span class="stat-number" data-count="1500+">0</span>
                    <span class="stat-label">Santri</span>
                </div>
            </div>
            <!-- Stat 2 -->
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift decorative-border">
                    <span class="stat-number" data-count="25+">0</span>
                    <span class="stat-label">Tahun Berdiri</span>
                </div>
            </div>
            <!-- Stat 3 - Highlighted -->
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift decorative-border stat-highlight">
                    <span class="stat-number" data-count="50+">0</span>
                    <span class="stat-label">Ustadz & Ustadzah</span>
                </div>
            </div>
            <!-- Stat 4 -->
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift decorative-border">
                    <span class="stat-number" data-count="100+">0</span>
                    <span class="stat-label">Lulusan Berprestasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section with asymmetric layout -->
<section class="about-section py-5 position-relative">
    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Image on left for asymmetric effect -->
            <div class="col-lg-6 order-lg-1">
                <div class="about-image hover-lift decorative-border position-relative">
                    <img src="https://via.placeholder.com/600x400?text=Kegiatan+Pesantren" alt="Kegiatan Pesantren" class="img-fluid rounded">
                    <!-- Decorative overlay -->
                    <div class="about-decoration position-absolute top-0 start-0 w-100 h-100">
                        <div class="ornamental-corner top-left"></div>
                        <div class="ornamental-corner top-right"></div>
                        <div class="ornamental-corner bottom-left"></div>
                        <div class="ornamental-corner bottom-right"></div>
                    </div>
                </div>
            </div>
            <!-- Text on right -->
            <div class="col-lg-6 order-lg-2">
                <h2 class="section-title mb-4">Sejarah Singkat Pesantren</h2>
                <p class="lead">
                    Pesantren {{ $settings?->nama_pesantren ?? 'Nama Pesantren' }} didirikan pada tahun {{ $settings?->tahun_berdiri ?? 'XXXX' }} oleh Kyai {{ $settings?->pendiri ?? 'Nama Pendiri' }} dengan visi menciptakan generasi yang berilmu, berakhlak, dan berkompeten dalam menghadapi tantangan zaman modern.
                </p>
                <p>
                    Dengan pendekatan pendidikan yang menggabungkan buku kuning klassik dengan kurikulum modern, pesantren kami telah menghasilkan ribuan lulusan yang menjadi tokoh-tokoh masyarakat, akademisi, dan pemimpin dalam berbagai bidang.
                </p>
                <a href="{{ route('cms.about') }}" class="btn btn-outline-primary mt-3">
                    Baca Selengkapnya <i class="fas fa-arrow-right ms-2 h-4 w-4"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Recent News -->
<section class="news-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Berita & Kegiatan Terbaru</h2>
            <p class="section-subtitle">Update terbaru dari kegiatan-kegiatan pesantren kami</p>
        </div>

        @if($recentPosts->isNotEmpty())
        <div class="row g-4">
            @foreach($recentPosts as $post)
            <div class="col-md-4">
                <div class="news-card h-100 hover-lift decorative-border">
                    @if($post->featured_image)
                    <div class="news-image">
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->judul }}" class="img-fluid rounded-top" loading="lazy">
                    </div>
                    @endif
                    <div class="news-content p-4">
                        <span class="news-category badge bg-primary mb-3">
                            {{ $post->category->nama ?? 'Umum' }}
                        </span>
                        <h3 class="news-title h4">
                            <a href="{{ route('cms.news.show', $post->slug) }}">{{ $post->judul }}</a>
                        </h3>
                        <p class="news-excerpt text-muted mb-3">
                            {{ Str::limit(strip_tags($post->isi), 120) }}
                        </p>
                        <div class="news-meta d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1 h-4 w-4"></i>
                                {{ $post->published_at ?->format('d F Y') }}
                            </small>
                            <a href="{{ route('cms.news.show', $post->slug) }}" class="btn-link text-primary">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1 h-4 w-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info">
            Belum ada berita yang dipublikasikan.
        </div>
        @endif
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Galeri Foto</h2>
            <p class="section-subtitle">Kegiatan dan momen-momen berharga pesantren kami</p>
        </div>

        @if($galleryImages->isNotEmpty())
        <div class="row g-4">
            @foreach($galleryImages->take(6) as $gallery)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="gallery-item hover-lift decorative-border position-relative">
                    <div class="placeholder position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->judul }}" class="img-fluid rounded gallery-img" loading="lazy" onload="this.previousElementSibling.style.display='none';">
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">{{ $gallery->judul }}</h3>
                        <p class="gallery-description">{{ Str::limit($gallery->deskripsi, 60) }}</p>
                        <a href="{{ asset('storage/'.$gallery->image_path) }}" target="_blank"
                            class="btn btn-primary btn-sm mt-3">
                            <i class="fas fa-arrows-alt ms-2 h-4 w-4"></i> Lihat Fullsize
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('cms.gallery') }}" class="btn btn-outline-primary">
                Lihat Semua Galeri <i class="fas fa-arrow-right ms-2 h-4 w-4"></i>
            </a>
        </div>
        @else
        <div class="alert alert-info">
            Belum ada galeri foto yang tersedia.
        </div>
        @endif
    </div>
</section>

<!-- Call to Action with enhanced design -->
<section class="cta-section py-5 position-relative">
    <div>
        <!-- Geometric pattern overlay -->
        <div class="cta-pattern-overlay"></div>
    </div>
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <h2 class="cta-title">Siap Bergabung dengan Komunitas Pesantren Kami?</h2>
                <p class="cta-subtitle">
                    Pendaftaran Santri Baru tahun pelajaran berikutnya sudah dibuka. Daftar sekarang dan rasakan pengalaman pendidikan yang unik dan bermakna.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('cms.psb') }}" class="btn btn-primary btn-lg px-5">
                    Daftar Sekarang <i class="fas fa-arrow-right ms-2 h-4 w-4"></i>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Counter animation
    document.addEventListener('DOMContentLoaded', function() {
        counters = document.querySelectorAll('.stat-number');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count').replace(/\D/g, ''));
            let count = 0;
            const increment = Math.ceil(target / 100); // Adjust speed

            const updateCounter = () => {
                if (count < target) {
                    count += increment;
                    if (count > target) count = target;
                    counter.textContent = count.toLocaleString();
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target.toLocaleString();
                }
            };

            updateCounter();
        });
    });

    // Hero slideshow
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.hero-slideshow .slide');
        const navDots = document.querySelectorAll('.hero-slideshow .nav-dot');
        let currentSlide = 0;

        if (slides.length > 0) {
            // Auto-advance slides every 5 seconds
            setInterval(() => {
                // Remove active class from current slide and dot
                slides[currentSlide].classList.remove('active');
                navDots[currentSlide].classList.remove('active');

                // Move to next slide
                currentSlide = (currentSlide + 1) % slides.length;

                // Add active class to new slide and dot
                slides[currentSlide].classList.add('active');
                navDots[currentSlide].classList.add('active');
            }, 5000);

            // Manual navigation via dots
            navDots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    // Remove active class from current slide and dot
                    slides[currentSlide].classList.remove('active');
                    navDots[currentSlide].classList.remove('active');

                    // Move to clicked slide
                    currentSlide = index;

                    // Add active class to new slide and dot
                    slides[currentSlide].classList.add('active');
                    navDots[currentSlide].classList.add('active');
                });
            });
        }
    });

    // Scroll animations with IntersectionObserver (PRD compliant)
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    // Unobserve if we only want to animate once
                    // observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements that should animate on scroll
        const scrollElements = document.querySelectorAll(
            '.hero-content, .stats-section, .about-section, .news-section, .gallery-section, .cta-section'
        );

        scrollElements.forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush