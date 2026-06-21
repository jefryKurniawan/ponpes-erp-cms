@extends('layouts.admin')

@section('title', 'Edit Pengaturan Sistem | Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Pengaturan Sistem</h1>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <label for="type" class="col-md-2 col-form-label">Tipe Pengaturan</label>
            <div class="col-md-10">
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $setting->type) }}" required placeholder="misal: pesantren, site, seo">
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="nama_pesantren" class="col-md-2 col-form-label">Nama Pesantren</label>
            <div class="col-md-10">
                <input type="text" class="form-control @error('nama_pesantren') is-invalid @enderror" id="nama_pesantren" name="nama_pesantren" value="{{ old('nama_pesantren', $setting->nama_pesantren) }}">
                @error('nama_pesantren')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tahun_berdiri" class="col-md-2 col-form-label">Tahun Berdiri</label>
            <div class="col-md-10">
                <input type="number" class="form-control @error('tahun_berdiri') is-invalid @enderror" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $setting->tahun_berdiri) }}" min="1900" max="{{ now()->year }}">
                @error('tahun_berdiri')
                    <div class="invalid-feedback>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="pendiri" class="col-md-2 col-form-label">Pendiri</label>
            <div class="col-md-10">
                <input type="text" class="form-control @error('pendiri') is-invalid @enderror" id="pendiri" name="pendiri" value="{{ old('pendiri', $setting->pendiri) }}">
                @error('pendiri')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="isi" class="col-md-2 col-form-label">Visi</label>
            <div class="col-md-10">
                <textarea class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" rows="3">{{ old('isi', $setting->isi) }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="isi_misi" class="col-md-2 col-form-label">Misi</label>
            <div class="col-md-10">
                <textarea class="form-control @error('isi_misi') is-invalid @enderror" id="isi_misi" name="isi_misi" rows="3">{{ old('isi_misi', $setting->isi_misi) }}</textarea>
                @error('isi_misi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_buka" class="col-md-2 col-form-label">Tanggal Buka Pendaftaran</label>
            <div class="col-md-10">
                <input type="date" class="form-control @error('tanggal_buka') is-invalid @enderror" id="tanggal_buka" name="tanggal_buka" value="{{ old('tanggal_buka', $setting->tanggal_buka) }}">
                @error('tanggal_buka')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_tutup" class="col-md-2 col-form-label">Tanggal Tutup Pendaftaran</label
            <div class="col-md-10">
                <input type="date" class="form-control @error('tanggal_tutup') is-invalid @enderror" id="tanggal_tutup" name="tanggal_tutup" value="{{ old('tanggal_tutup', $setting->tanggal_tutup) }}">
                @error('tanggal_tutup')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_seleksi_akademik" class="col-md-2 col-form-label">Tanggal Seleksi Akademik</label>
            <div class="col-md-10">
                <input type="date" class="form-control @error('tanggal_seleksi_akademik') is-invalid @enderror" id="tanggal_seleksi_akademik" name="tanggal_seleksi_akademik" value="{{ old('tanggal_seleksi_akademik', $setting->tanggal_seleksi_akademik) }}">
                @error('tanggal_seleksi_akademik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="tanggal_pengumuman" class="col-md-2 col-form-label">Tanggal Pengumuman Seleksi</label>
            <div class="col-md-10">
                <input type="date" class="form-control @error('tanggal_pengumuman') is-invalid @enderror" id="tanggal_pengumuman" name="tanggal_pengumuman" value="{{ old('tanggal_pengumuman', $setting->tanggal_pengumuman) }}">
                @error('tanggal_pengumuman')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="biaya_pendaftaran" class="col-md-2 col-form-label">Biaya Pendaftaran</label>
            <div class="col-md-10">
                <input type="number" class="form-control @error('biaya_pendaftaran') is-invalid @enderror" id="biaya_pendaftaran" name="biaya_pendaftaran" value="{{ old('biaya_pendaftaran', $setting->biaya_pendaftaran) }}" step="0.01" min="0">
                @error('biaya_pendaftaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Dalam Rupiah (misal: 500000 untuk Rp500.000)</small>
            </div>
        </div>

        <div class="row mb-3">
            <label for="biaya_spp" class="col-md-2 col-form-label">Biaya SPP/Bulan</label>
            <div class="col-md-10">
                <input type="number" class="form-control @error('biaya_spp') is-invalid @enderror" id="biaya_spp" name="biaya_spp" value="{{ old('biaya_spp', $setting->biaya_spp) }}" step="0.01" min="0">
                @error('biaya_spp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Dalam Rupiah (misal: 300000 untuk Rp300.000)</small>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2"></div
            <div class="col-md-10">
                <button type="submit" class="btn btn-primary">Update Pengaturan</button>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection