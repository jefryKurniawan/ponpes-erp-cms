@extends('layouts.admin')

@section('title', 'Detail Pengaturan Sistem | Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengaturan Sistem</h1>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tipe Pengaturan:</strong>
                        <p class="mb-2">{{ $setting->type }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Nama Pesantren:</strong>
                        <p class="mb-2">{{ $setting->nama_pesantren ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tahun Berdiri:</strong>
                        <p class="mb-2">{{ $setting->tahun_berdiri ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Pendiri:</strong>
                        <p class="mb-2">{{ $setting->pendiri ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Visi:</strong>
                        <p class="mb-2">{{ $setting->isi ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Misi:</strong>
                        <p class="mb-2">{{ $setting->isi_misi ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tanggal Buka Pendaftaran:</strong>
                        <p class="mb-2">{{ $setting->tanggal_buka ? $setting->tanggal_buka->format('d F Y') : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Tanggal Tutup Pendaftaran:</strong>
                        <p class="mb-2">{{ $setting->tanggal_tutup ? $setting->tanggal_tutup->format('d F Y') : '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Tanggal Seleksi Akademik:</strong>
                        <p class="mb-2">{{ $setting->tanggal_seleksi_akademik ? $setting->tanggal_seleksi_akademik->format('d F Y') : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Tanggal Pengumuman Seleksi:</strong>
                        <p class="mb-2">{{ $setting->tanggal_pengumuman ? $setting->tanggal_pengumuman->format('d F Y') : '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Biaya Pendaftaran:</strong>
                        <p class="mb-2">{{ $setting->biaya_pendaftaran ? 'Rp ' . number_format($setting->biaya_pendaftaran, 0, ',', '.') : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Biaya SPP/Bulan:</strong>
                        <p class="mb-2">{{ $setting->biaya_spp ? 'Rp ' . number_format($setting->biaya_spp, 0, ',', '.') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection