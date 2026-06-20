<header class="header">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <ul class="top-bar-list list-unstyled mb-0 d-flex flex-wrap">
                        <li class="me-4 mb-2 mb-md-0">
                            <i class="fas fa-map-marker-alt me-2 h-4 w-4"></i>
                            Desa Pesantren, Kec. Kab. Kabupaten, Provinsi
                        </li>
                        <li class="me-4 mb-2 mb-md-0">
                            <i class="fas fa-phone me-2 h-4 w-4"></i>
                            +62 812-3456-7890
                        </li>
                        <li class="me-4 mb-2 mb-md-0">
                            <i class="fas fa-envelope me-2 h-4 w-4"></i>
                            info@pesantren.example.com
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex align-items-center">
                        <ul class="top-bar-social list-unstyled mb-0 d-flex">
                            <li class="me-3">
                                <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f h-4 w-4"></i></a>
                            </li>
                            <li class="me-3">
                                <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter h-4 w-4"></i></a>
                            </li>
                            <li class="me-3">
                                <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram h-4 w-4"></i></a>
                            </li>
                            <li class="me-3">
                                <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube h-4 w-4"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light organic-navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('cms.home') }}">
                <div class="brand-logo me-3">
                    <img src="https://via.placeholder.com/80x80?text=Logo" alt="Pesantren Logo" height="48" width="48">
                </div>
                <div class="brand-text">
                    <h1 class="mb-0 brand-name">{{ $settings?->nama_pesantren ?? 'Pesantren' }}</h1>
                    <small class="brand-tagline">Pendidikan Islam Berbasis Nilai</small>
                    <div class="brand-decoration">
                        <div class="organic-line"></div>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ Request::is('cms*') ? 'active' : '' }}" href="{{ route('cms.home') }}"><span class="nav-link-text">Beranda</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ Request::is('cms/about*') ? 'active' : '' }}" href="{{ route('cms.about') }}"><span class="nav-link-text">Tentang Kami</span></a>
                    </li>
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle px-3 py-2 {{ Request::is('cms/news*') ? 'active' : '' }}" href="#" id="navbarNewsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            <span class="nav-link-text">Berita & Kegiatan</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-start" aria-labelledby="navbarNewsDropdown">
                            <li>
                                <a class="dropdown-item px-3 py-2" href="{{ route('cms.news.index') }}"><span class="dropdown-item-text">Daftar Berita</span></a>
                            </li>
                            <li>
                                <a class="dropdown-item px-3 py-2" href="{{ route('cms.news.index') }}#!agenda"><span class="dropdown-item-text">Agenda & Kegiatan</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item px-3 py-2" href="{{ route('cms.gallery') }}"><span class="dropdown-item-text">Galeri Foto</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 {{ Request::is('cms/psb*') ? 'active' : '' }}" href="{{ route('cms.psb') }}"><span class="nav-link-text">Pendaftaran Santri Baru</span></a>
                    </li>
                    <!-- Search form will be implemented later -->
                    <!--
                    <li class="nav-item d-none">
                        <form class="d-md-block ms-3" action="{{ route('cms.news.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Cari berita..." name="q" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                    -->
                </ul>
            </div>
        </div>
    </nav>
</header>