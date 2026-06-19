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
                        <a href="{{ route('cms.psb') }}" class="btn btn-sm btn-outline-primary ms-3 ms-md-0">
                            Pendaftaran Online
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('cms.home') }}">
                <div class="brand-logo">
                    <img src="https://via.placeholder.com/200x80?text=Logo" alt="Pesantren Logo" height="40">
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
                        <a class="nav-link dropdown-toggle {{ Request::is('cms/news*') ? 'active' : '' }}" href="#" id="navbarNewsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
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