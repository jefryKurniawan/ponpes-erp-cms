@extends('layouts.cms')

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">Tentang Kami</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cms.about') }}">Tentang Kami</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</section>

<!-- About Content -->
<section class="about-content py-5">
    <div class="container">
        @if($history)
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="section-title">Sejarah Pesantren</h2>
                <div class="history-content">
                    {!! nl2br($history->isi) !!}
                </div>
            </div>
        </div>
        @endif

        @if($visionMission)
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Visi Pesantren</h2>
                <div class="vision-content">
                    {!! nl2br($visionMission->isi) !!}
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Misi Pesantren</h2>
                <div class="mission-content">
                    {!! nl2br($visionMission->isi_misi) !!}
                </div>
            </div>
        </div>
        @endif

        <!-- Facilities -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Fasilitas Pesantren</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Facility items would come from settings or database -->
                    <div class="col">
                        <div class="facility-card h-100 text-center p-4 bg-light rounded hover-lift decorative-border">
                            <div class="facility-icon mb-3">
                                <i class="fas fa-book-open fs-1 text-primary"></i>
                            </div>
                            <h5 class="facility-title">Perpustakaan Lengkap</h5>
                            <p class="fasilitas-text">
                                Kepustakaan dengan ribuan kitab klasik dan buku modern untuk mendukung proses belajar mengajar.
                            </p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="facility-card h-100 text-center p-4 bg-light rounded hover-lift decorative-border">
                            <div class="facility-icon mb-3">
                                <i class="fas fa-building fs-1 text-primary"></i>
                            </div>
                            <h5 class="facility-title">Masjid dan Musala</h5>
                            <p class="fasilitas-text">
                                Tempat ibadah yang nyaman dan kondusif untuk kegiatan keagamaan sehari-hari.
                            </p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="facility-card h-100 text-center p-4 bg-light rounded hover-lift decorative-border">
                            <div class="facility-icon mb-3">
                                <i class="fas fa-bed fs-1 text-primary"></i>
                            </div>
                            <h5 class="facility-title">Asrama Modern</h5>
                            <p class="fasilitas-text">
                                Fasilitas asrama yang nyaman dengan kamar tidur, kamar mandi, dan area belajar collectiv.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection