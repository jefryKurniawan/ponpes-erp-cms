@extends('layouts.admin')

@section('title', $gallery->nama . ' | Admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">{{ $gallery->nama }}</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Detail informasi galeri</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.galeri.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                    Kembali
                </a>
                @can('admin', 'bendahara')
                <a href="{{ route('admin.galeri.edit', $gallery->id) }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
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
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Gambar Sampul</h3>
            @if($gallery->gambar && file_exists(public_path('storage/'.$gallery->gambar)))
                <img src="{{ asset('storage/'.$gallery->gambar) }}" class="w-full rounded-lg" alt="Sampul Galeri">
            @else
                <div class="bg-surface-container rounded-lg p-8 text-center">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/50 mb-2">images</span>
                    <p class="text-on-surface-variant text-sm">Tidak ada gambar sampul</p>
                </div>
            @endif
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi</h3>
            <dl class="space-y-3">
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Status Aktif</dt>
                    <dd>
                        @if($gallery->is_active == 1)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-success/10 text-success">Aktif</span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">Tidak Aktif</span>
                        @endif
                    </dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tanggal Pembuatan</dt>
                    <dd class="text-on-surface">{{ $gallery->created_at ? $gallery->created_at->format('d M Y H:i') : '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b border-outline-variant/10">
                    <dt class="font-label-sm text-on-surface-variant">Tanggal Perbaruan</dt>
                    <dd class="text-on-surface">{{ $gallery->updated_at ? $gallery->updated_at->format('d M Y H:i') : '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    @if(!empty($gallery->keterangan))
        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20 mb-6">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Keterangan</h3>
            <p class="text-on-surface whitespace-pre-line">{{ $gallery->keterangan }}</p>
        </div>
    @endif

    @can('admin', 'bendahara')
    <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Daftar Gambar dalam Galeri</h3>
        <div class="bg-info-container/10 border border-info/20 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-info text-xl">info</span>
                <p class="text-on-surface-variant text-sm">Fitur manajemen gambar dalam galeri akan diimplementasikan dalam modul yang terpisah.</p>
            </div>
        </div>
    </div>
    @endcan
</div>
@endsection