@extends('layouts.cms')

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">Pendaftaran Santri Baru</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cms.psb') }}">Pendaftaran Santri Baru</a></li>
                <li class="breadcrumb-item active" aria-current="page">PSB</li>
            </ol>
        </nav>
    </div>
</section>

<!-- PSB Info -->
<section class="psb-info py-5">
    <div class="container">
        @if($psbInfo)
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Informasi PSB</h2>
                <div class="psb-content">
                    {!! nl2br($psbInfo->isi) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="psb-image hover-lift decorative-border">
                    <img src="{{ asset('assets/img/psb-info.jpg') }}" alt="Pendaftaran Santri Baru" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>

        <!-- Requirements -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Syarat Pendaftaran</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-4">Syarat Umum</h3>
                        <ul class="list-unstyled psb-requirements">
                            <li><i class="fas fa-check-circle text-primary me-2"></i> Berkelakuan Baik</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i> Sejahtera Jasmani dan Rohani</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i> Usia sesuai jenjang pendidikan</li>
                            <li><i class="fas fa-check-circle text-primary me-2"></i> Memiliki minat dalam pendidikan Islam</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4">Dokumen yang Diperlukan</h3>
                        <ul class="list-unstyled psb-requirements">
                            <li><i class="fas fa-file-alt text-primary me-2"></i> Fotokopi KK</li>
                            <li><i class="fas fa-file-alt text-primary me-2"></i> Fotokopi Akta Kelahiran</li>
                            <li><i class="fas fa-file-alt text-primary me-2"></i> Foto berwarna 3x4 (2 lembar)</li>
                            <li><i class="fas fa-file-alt text-primary me-2"></i> Surat keterangan sehat dari dokter</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Dates -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="section-title">Jadwal Penting PSB</h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fas fa-calendar-alt me-2"></i> Pembukaan Pendaftaran</td>
                                <td class="text-center">{{ $psbInfo->tanggal_buka ?? '01 Juli 2026' }}</td>
                                <td>Pendaftaran secara online dibuka</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-calendar-alt me-2"></i> Penutupan Pendaftaran</td>
                                <td class="text-center">{{ $psbInfo->tanggal_tutup ?? '31 Agustus 2026' }}</td>
                                <td>Silakan lengkapi pendaftaran sebelum batas ini</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-user-graduate me-2"></i> Seleksi Administrasi</td>
                                <td class="text-center">{{ $psbInfo->tanggal_seleksi_admin ?? '05 September 2026' }}</td>
                                <td>Pengecekan kelengkapan berkas</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-chalkboard-teacher me-2"></i> Seleksi Akademik</td>
                                <td class="text-center">{{ $psbInfo->tanggal_seleksi_akademik ?? '10 September 2026' }}</td>
                                <td>Tes bacaan Al-Qur'an dan dasar-dasar Islam</td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-users me-2"></i> Pengumuman Lulusan</td>
                                <td class="text-center">{{ $psbInfo->tanggal_pengumuman ?? '20 September 2026' }}</td>
                                <td>Pengumuman dilakukan melalui website dan SMS</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($psbInfo->biaya_pendaftaran || $psbInfo->biaya_spp)
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Informasi Biaya</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box p-4 bg-light rounded hover-lift decorative-border">
                            <h5><i class="fas fa-mehrab text-primary me-2"></i> Biaya Pendaftaran</h5>
                            <p class="h4 mb-0">Rp {{ number_format($psbInfo->biaya_pendaftaran ?? 0, 0, ',', '.') }}</p>
                            <small class="text-muted">Sekali pembayaran saat pendaftaran</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box p-4 bg-light rounded hover-lift decorative-border">
                            <h5><i class="fas fa-university text-primary me-2"></i> SPP Bulanan</h5>
                            <p class="h4 mb-0">Rp {{ number_format($psbInfo->biaya_spp ?? 0, 0, ',', '.') }}</p>
                            <small class="text-muted">Dibayar setiap bulan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="text-center mt-5">
            <a href="{{ route('cms.psb.form') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-edit me-2"></i> Isi Formulir Pendaftaran
            </a>
        </div>
        @else
        <div class="alert alert-info">
            Informasi PSB sedang diperbarui. Silakan hubungi kontak kami untuk informasi selengkapnya.
        </div>
        @endif
    </div>
</section>
@endsection