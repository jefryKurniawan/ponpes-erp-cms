@extends('layouts.admin')

@section('title', 'Detail Pengaturan CMS')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Detail Pengaturan CMS</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Informasi lengkap pengaturan sistem CMS</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.cms.settings.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                    Kembali
                </a>
                @can('admin', 'bendahara')
                <a href="{{ route('admin.cms.settings.edit', $setting->id) }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Edit
                </a>
                @endcan
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-success bg-success-container/10 p-4">
            <p class="font-body-sm text-success">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Pesantren</h3>
            <dl class="space-y-3">
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tipe Pengaturan</dt>
                    <dd class="text-on-surface">{{ ucfirst($setting->type) }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Nama Pesantren</dt>
                    <dd class="text-on-surface">{{ $setting->nama_pesantren ?? '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tahun Berdiri</dt>
                    <dd class="text-on-surface">{{ $setting->tahun_berdiri ?? '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Pendiri</dt>
                    <dd class="text-on-surface">{{ $setting->pendiri ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Visi & Misi</h3>
            <dl class="space-y-3">
                <div class="py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant mb-1">Visi</dt>
                    <dd class="text-on-surface">{{ $setting->isi ?? '-' }}</dd>
                </div>
                <div class="py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant mb-1">Misi</dt>
                    <dd class="text-on-surface">{{ $setting->isi_misi ?? '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Tanggal Penting</h3>
            <dl class="space-y-3">
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tanggal Buka Pendaftaran</dt>
                    <dd class="text-on-surface">{{ $setting->tanggal_buka ? $setting->tanggal_buka->format('d M Y') : '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tanggal Tutup Pendaftaran</dt>
                    <dd class="text-on-surface">{{ $setting->tanggal_tutup ? $setting->tanggal_tutup->format('d M Y') : '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tanggal Seleksi Akademik</dt>
                    <dd class="text-on-surface">{{ $setting->tanggal_seleksi_akademik ? $setting->tanggal_seleksi_akademik->format('d M Y') : '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tanggal Pengumuman Seleksi</dt>
                    <dd class="text-on-surface">{{ $setting->tanggal_pengumuman ? $setting->tanggal_pengumuman->format('d M Y') : '-' }}</dd>
                </div>
            </dl>
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Biaya</h3>
            <dl class="space-y-3">
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Biaya Pendaftaran</dt>
                    <dd class="text-on-surface">{{ $setting->biaya_pendaftaran ? 'Rp ' . number_format($setting->biaya_pendaftaran, 0, ',', '.') : '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Biaya SPP/Bulan</dt>
                    <dd class="text-on-surface">{{ $setting->biaya_spp ? 'Rp ' . number_format($setting->biaya_spp, 0, ',', '.') : '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @if($setting->created_at || $setting->updated_at)
        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Sistem</h3>
            <dl class="space-y-3">
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Dibuat Pada</dt>
                    <dd class="text-on-surface">{{ $setting->created_at ? $setting->created_at->format('d M Y H:i') : '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Diperbarui Pada</dt>
                    <dd class="text-on-surface">{{ $setting->updated_at ? $setting->updated_at->format('d M Y H:i') : '-' }}</dd>
                </div>
            </dl>
        </div>
    @endif
</div>
@endsection