<header class="header">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="top-bar-list list-unstyled mb-0">
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Desa Pesantren, Kec. Kab. Kabupaten, Provinsi
                        </li>
                        <li class="ms-3">
                            <i class="fas fa-phone me-2"></i>
                            +62 812-3456-7890
                        </li>
                        <li class="ms-3">
                            <i class="fas fa-envelope me-2"></i>
                            info@pesantren.example.com
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="top-bar-social list-unstyled mb-0">
                        <li>
                            <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#" class="me-3"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="{{ route('cms.psb') }}" class="btn btn-sm btn-outline-primary me-0">
                                Pendaftaran Online
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('cms.home') }}">
                <div class="brand-logo">
                    <img src="{{ asset('assets/img/ponpes-logo.png') }}" alt="Pesantren Logo" height="40">
                </div>
                <div class="brand-text">
                    <h1 class="mb-0">Pesantren Nama</h1>
                    <small>Pendidikan Islam Berbasis Nilai</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('cms*') ? 'active' : '' }}" href="{{ route('cms.home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('cms/about*') ? 'active' : '' }}" href="{{ route('cms.about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('cms/news*') ? 'active' : '' }}" href="#" id="navbarNewsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Berita & Kegiatan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarNewsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('cms.news.index') }}">Daftar Berita</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cms.news.index') }}#!agenda">Agenda & Kegiatan</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cms.gallery') }}">Galeri Foto</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('cms/psb*') ? 'active' : '' }}" href="{{ route('cms.psb') }}">Pendaftaran Santri Baru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cms.contact') }}">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <form class="d-none d-md-block ms-3" action="{{ route('cms.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="Cari..." name="q" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>