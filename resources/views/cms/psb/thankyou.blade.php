@extends('layouts.cms')

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">Terima Kasih!</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cms.psb') }}">Pendaftaran Santri Baru</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terima Kasih</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Thank You Message -->
<section class="thank-you py-5 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="icon-container mb-4">
                    <div class="icon-bg">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    </div>
                </div>

                <h2 class="display-4 mb-4">Pendaftaran Anda Telah Diterima!</h2>
                <p class="lead mb-5">
                    Kami akan menghubungi Anda melalui email atau WhatsApp dalam 2x24 jam untuk selanjutnya proses pendaftaran.
                </p>

                <div class="info-box p-4 bg-light rounded hover-lift decorative-border mb-5">
                    <h3>Apa Selanjutnya?</h3>
                    <ol class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i> Tim kami akan verifikasi dokumen yang Anda upload</li>
                        <li><i class="fas fa-phone me-2"></i> Anda akan menerima panggilan untuk konfirmasi jadwal seleksi</li>
                        <li><i class="fas fa-file-alt me-2"></i> Jika lolos administrasi, Anda akan diundang untuk tes akademik dan tahfidz</li>
                        <li><i class="fas fa-calendar me-2"></i> Pengumuman akhir akan dilakukan melalui website dan SMS</li>
                    </ol>
                </div>

                <div class="btn-group btn-group-lg mt-4">
                    <a href="{{ route('cms.home') }}" class="btn btn-outline-primary me-3">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                    <a href="{{ route('cms.psb') }}" class="btn btn-primary">
                        <i class="fas fa-school me-2"></i> Informasi PSB Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Info -->
<section class="additional-info py-5 bg-light">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="info-card p-4 h-100 hover-lift decorative-border">
                    <div class="icon mb-3">
                        <i class="fas fa-clock fs-1 text-primary"></i>
                    </div>
                    <h5>Proses Cepat</h5>
                    <p class="text-muted">
                        Kami berkomitmen untuk memproses pendaftaran Anda secara cepat dan transparan.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card p-4 h-100 hover-lift decorative-border">
                    <div class="icon mb-3">
                        <i class="fas fa-headset fs-1 text-primary"></i>
                    </div>
                    <h5>Dukungan Penuh</h5>
                    <p class="text-muted">
                        Tim pengambilan peserta kami siap membantu Anda selama proses pendaftaran.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card p-4 h-100 hover-lift decorative-border">
                    <div class="icon mb-3">
                        <i class="fas fa-graduation-cap fs-1 text-primary"></i>
                    </div>
                    <h5>Jaminan Kualitas</h5>
                    <p class="text-muted">
                        Pesantren kami terakreditasi dan memiliki rekam jejak prestasi yang baik.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection