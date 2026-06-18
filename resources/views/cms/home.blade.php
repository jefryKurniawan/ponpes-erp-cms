@extends('layouts.cms')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title display-4">
                    Selamat Datang di Pesantren {{ $settings->nama_pesantren ?? 'Nama Pesantren' }}
                </h1>
                <p class="hero-subtitle lead">
                    Lembaga pendidikan Islam yang berkomitmen pada kecemerlangan akademik dan pembentukan karakter berdasarkan nilai-nilai keslaman.
                </p>
                <div class="hero-actions mt-4">
                    <a href="{{ route('cms.psb') }}" class="btn btn-primary btn-lg me-3">
                        Pendaftaran Santri Baru
                    </a>
                    <a href="{{ route('cms.about') }}" class="btn btn-outline-light btn-lg">
                        Tentang Kami
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image hover-lift">
                    <img src="https://via.placeholder.com/600x400?text=Pesantren" alt="Pesantren" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift">
                    <span class="stat-number" data-count="1500+">0</span>
                    <span class="stat-label">Santri</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift">
                    <span class="stat-number" data-count="25+">0</span>
                    <span class="stat-label">Tahun Berdiri</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift">
                    <span class="stat-number" data-count="50+">0</span>
                    <span class="stat-label">Ustadz & Ustadzah</span>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="stat-item hover-lift">
                    <span class="stat-number" data-count="100+">0</span>
                    <span class="stat-label">Lulusan Berprestasi</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
                <div class="about-image hover-lift">
                    <img src="https://via.placeholder.com/600x400?text=Kegiatan+Pesantren" alt="Kegiatan Pesantren" class="img-fluid rounded shadow">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="section-title mb-4">Sejarah Singkat Pesantren</h2>
                <p class="lead">
                    Pesantren {{ $settings->nama_pesantren ?? 'Nama Pesantren' }} didirikan pada tahun {{ $settings->tahun_berdiri ?? 'XXXX' }} oleh Kyai {{ $settings->pendiri ?? 'Nama Pendiri' }} dengan visi menciptakan generasi yang berilmu, berakhlak, dan berkompeten dalam enfrentasi zaman modern.
                </p>
                <p>
                    Dengan pendekatan pendidikan yang menggabungkan buku kuning klassik dengan kurikulum modern, pesantren kami telah menghasilkan ribuan lulusan yang menjadi tokoh-tokoh masyarakat, akademisi, dan pemimpin dalam berbagai bidang.
                </p>
                <a href="{{ route('cms.about') }}" class="btn btn-outline-primary mt-3">
                    Baca Selengkapnya <x-heroicon-o-arrow-right class="ms-2 h-4 w-4"/>
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
        <div class="row">
            @foreach($recentPosts as $post)
            <div class="col-md-4 mb-4">
                <div class="news-card h-100 hover-lift">
                    @if($post->thumbnail)
                    <div class="news-image">
                        <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->judul }}" class="img-fluid rounded-top">
                    </div>
                    @endif
                    <div class="news-content p-3">
                        <span class="news-category badge bg-primary mb-2">
                            {{ $post->category->nama ?? 'Umum' }}
                        </span>
                        <h3 class="news-title h5">
                            <a href="{{ route('cms.news.show', $post->slug) }}">{{ $post->judul }}</a>
                        </h3>
                        <p class="news-excerpt text-muted mb-3">
                            {{ Str::limit(strip_tags($post->isi), 100) }}
                        </p>
                        <div class="news-meta d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <x-heroicon-o-calendar class="me-1 h-4 w-4"/>
                                {{ $post->published_at ?->format('d F Y') }}
                            </small>
                            <a href="{{ route('cms.news.show', $post->slug) }}" class="btn-link">
                                Baca Selengkapnya <x-heroicon-o-arrow-right class="ms-1 h-4 w-4"/>
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
                <div class="gallery-item hover-lift">
                    <img src="{{ asset('storage/'.$gallery->image_path) }}" alt="{{ $gallery->judul }}"
                        class="img-fluid rounded gallery-img">
                    <div class="gallery-overlay">
                        <h3>{{ $gallery->judul }}</h3>
                        <p class="gallery-description">{{ Str::limit($gallery->deskripsi, 50) }}</p>
                        <a href="{{ asset('storage/'.$gallery->image_path) }}" target="_blank"
                            class="btn btn-primary btn-sm">
                            <x-heroicon-o-arrows-expand class="ms-2 h-4 w-4"/> Lihat Fullsize
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('cms.gallery') }}" class="btn btn-outline-primary">
                Lihat Semua Galeri <x-heroicon-o-arrow-right class="ms-2 h-4 w-4"/>
            </a>
        </div>
        @else
        <div class="alert alert-info">
            Belum ada galeri foto yang tersedia.
        </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="cta-title">Siap Bergabung dengan Komunitas Pesantren Kami?</h2>
                <p class="cta-subtitle">
                    Pendaftaran Santri Baru tahun pelajaran berikutnya sudah dibuka. Daftar sekarang dan rasakan pengalaman pendidikan yang unik dan bermakna.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('cms.psb') }}" class="btn btn-primary btn-lg">
                    Daftar Sekarang <x-heroicon-o-arrow-right class="ms-2 h-4 w-4"/>
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
        const counters = document.querySelectorAll('.stat-number');

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
</script>
@endpush