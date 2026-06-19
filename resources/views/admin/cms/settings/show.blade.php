@extends('layouts.home')

@section('title_page', 'Detail Pengaturan CMS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Pengaturan CMS</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.cms.settings.index') }}" class="btn btn-sm btn-outline-secondary">Kembali ke Daftar</a>
            @can('admin' , 'bendahara')
            <a href="{{ route('admin.cms.settings.edit', $setting->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            <dl class="row">
                <dt class="col-sm-3">Tipe Pengaturan</dt>
                <dd class="col-sm-9">{{ ucfirst($setting->type) }}</dd>

                <dt class="col-sm-3">Nama Pesantren</dt>
                <dd class="col-sm-9">{{ $setting->nama_pesantren ?? '-' }}</dd>

                <dt class="col-sm-3">Tahun Berdiri</dt>
                <dd class="col-sm-9">{{ $setting->tahun_berdiri ?? '-' }}</dd>

                <dt class="col-sm-3">Pendiri</dt>
                <dd class="col-sm-9">{{ $setting->pendiri ?? '-' }}</dd>

                <dt class="col-sm-3">Visi</dt>
                <dd class="col-sm-9">{{ $setting->isi ?? '-' }}</dd>

                <dt class="col-sm-3">Misi</dt>
                <dd class="col-sm-9">{{ $setting->isi_misi ?? '-' }}</dd>

                <dt class="col-sm-3">Tanggal Buka Pendaftaran</dt>
                <dd class="col-sm-9">{{ $setting->tanggal_buka ? $setting->tanggal_buka->format('d M Y') : '-' }}</dd>

                <dt class="col-sm-3">Tanggal Tutup Pendaftaran</dt>
                <dd class="col-sm-9">{{ $setting->tanggal_tutup ? $setting->tanggal_tutup->format('d M Y') : '-' }}</dd>

                <dt class="col-sm-3">Tanggal Seleksi Akademik</dt>
                <dd class="col-sm-9">{{ $setting->tanggal_seleksi_akademik ? $setting->tanggal_seleksi_akademik->format('d M Y') : '-' }}</dd>

                <dt class="col-sm-3">Tanggal Pengumuman Seleksi</dt>
                <dd class="col-sm-9">{{ $setting->tanggal_pengumuman ? $setting->tanggal_pengumuman->format('d M Y') : '-' }}</dd>

                <dt class="col-sm-3">Biaya Pendaftaran</dt>
                <dd class="col-sm-9">{{ $setting->biaya_pendaftaran ? 'Rp ' . number_format($setting->biaya_pendaftaran, 0, ',', '.') : '-' }}</dd>

                <dt class="col-sm-3">Biaya SPP/Bulan</dt>
                <dd class="col-sm-9">{{ $setting->biaya_spp ? 'Rp ' . number_format($setting->biaya_spp, 0, ',', '.') : '-' }}</dd>
            </dl>
        </div>
        <div class="col-md-6">
            @if($setting->created_at || $setting->updated_at)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informasi Sistem</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Dibuat Pada</dt>
                            <dd class="col-sm-9">{{ $setting->created_at ? $setting->created_at->format('d M Y H:i') : '-' }}</dd>

                            <dt class="col-sm-3">Diperbarui Pada</dt>
                            <dd class="col-sm-9">{{ $setting->updated_at ? $setting->updated_at->format('d M Y H:i') : '-' }}</dd>
                        </dl>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection