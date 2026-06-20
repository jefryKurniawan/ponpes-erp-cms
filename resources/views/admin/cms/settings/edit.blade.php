@extends('layouts.admin')

@section('title', 'Edit Pengaturan CMS')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Edit Pengaturan CMS</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Perbarui pengaturan sistem CMS.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-lg border border-error bg-error-container/10 p-4">
            <h4 class="font-label-md text-error mb-2">Validasi Error:</h4>
            <ul class="list-disc list-inside text-on-surface-variant">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
        <form action="{{ route('admin.cms.settings.update', $setting->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="type" class="block font-label-md text-on-surface mb-2">Tipe Pengaturan</label>
                <input type="text" class="cms-input w-full @error('type') border-error @enderror" id="type" name="type" value="{{ old('type', $setting->type) }}" required placeholder="misal: pesantren, site, seo">
                @error('type')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama_pesantren" class="block font-label-md text-on-surface mb-2">Nama Pesantren</label>
                <input type="text" class="cms-input w-full @error('nama_pesantren') border-error @enderror" id="nama_pesantren" name="nama_pesantren" value="{{ old('nama_pesantren', $setting->nama_pesantren) }}">
                @error('nama_pesantren')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tahun_berdiri" class="block font-label-md text-on-surface mb-2">Tahun Berdiri</label>
                <input type="number" class="cms-input w-full @error('tahun_berdiri') border-error @enderror" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $setting->tahun_berdiri) }}" min="1900" max="{{ now()->year }}">
                @error('tahun_berdiri')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="pendiri" class="block font-label-md text-on-surface mb-2">Pendiri</label>
                <input type="text" class="cms-input w-full @error('pendiri') border-error @enderror" id="pendiri" name="pendiri" value="{{ old('pendiri', $setting->pendiri) }}">
                @error('pendiri')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="isi" class="block font-label-md text-on-surface mb-2">Visi</label>
                <textarea class="cms-input w-full @error('isi') border-error @enderror" id="isi" name="isi" rows="3">{{ old('isi', $setting->isi) }}</textarea>
                @error('isi')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="isi_misi" class="block font-label-md text-on-surface mb-2">Misi</label>
                <textarea class="cms-input w-full @error('isi_misi') border-error @enderror" id="isi_misi" name="isi_misi" rows="3">{{ old('isi_misi', $setting->isi_misi) }}</textarea>
                @error('isi_misi')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_buka" class="block font-label-md text-on-surface mb-2">Tanggal Buka Pendaftaran</label>
                <input type="date" class="cms-input w-full @error('tanggal_buka') border-error @enderror" id="tanggal_buka" name="tanggal_buka" value="{{ old('tanggal_buka', $setting->tanggal_buka ? $setting->tanggal_buka->format('Y-m-d') : '') }}">
                @error('tanggal_buka')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_tutup" class="block font-label-md text-on-surface mb-2">Tanggal Tutup Pendaftaran</label>
                <input type="date" class="cms-input w-full @error('tanggal_tutup') border-error @enderror" id="tanggal_tutup" name="tanggal_tutup" value="{{ old('tanggal_tutup', $setting->tanggal_tutup ? $setting->tanggal_tutup->format('Y-m-d') : '') }}">
                @error('tanggal_tutup')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_seleksi_akademik" class="block font-label-md text-on-surface mb-2">Tanggal Seleksi Akademik</label>
                <input type="date" class="cms-input w-full @error('tanggal_seleksi_akademik') border-error @enderror" id="tanggal_seleksi_akademik" name="tanggal_seleksi_akademik" value="{{ old('tanggal_seleksi_akademik', $setting->tanggal_seleksi_akademik ? $setting->tanggal_seleksi_akademik->format('Y-m-d') : '') }}">
                @error('tanggal_seleksi_akademik')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_pengumuman" class="block font-label-md text-on-surface mb-2">Tanggal Pengumuman Seleksi</label>
                <input type="date" class="cms-input w-full @error('tanggal_pengumuman') border-error @enderror" id="tanggal_pengumuman" name="tanggal_pengumuman" value="{{ old('tanggal_pengumuman', $setting->tanggal_pengumuman ? $setting->tanggal_pengumuman->format('Y-m-d') : '') }}">
                @error('tanggal_pengumuman')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="biaya_pendaftaran" class="block font-label-md text-on-surface mb-2">Biaya Pendaftaran</label>
                <input type="number" class="cms-input w-full @error('biaya_pendaftaran') border-error @enderror" id="biaya_pendaftaran" name="biaya_pendaftaran" value="{{ old('biaya_pendaftaran', $setting->biaya_pendaftaran) }}" step="0.01" min="0">
                @error('biaya_pendaftaran')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Dalam Rupiah (misal: 500000 untuk Rp500.000)</p>
            </div>

            <div>
                <label for="biaya_spp" class="block font-label-md text-on-surface mb-2">Biaya SPP/Bulan</label>
                <input type="number" class="cms-input w-full @error('biaya_spp') border-error @enderror" id="biaya_spp" name="biaya_spp" value="{{ old('biaya_spp', $setting->biaya_spp) }}" step="0.01" min="0">
                @error('biaya_spp')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Dalam Rupiah (misal: 300000 untuk Rp300.000)</p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">Simpan Pengaturan</button>
                <a href="{{ route('admin.cms.settings.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection