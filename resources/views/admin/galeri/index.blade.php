@extends('layouts.admin')

@section('title', 'Data Galeri | Admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Data Galeri</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola galeri dokumentasi kegiatan pesantren</p>
            </div>
            @can('admin', 'bendahara')
            <a href="{{ route('admin.galeri.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                Tambah Galeri
            </a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg border border-success bg-success-container/10 p-4">
            <p class="font-body-sm text-success">{{ session('success') }}</p>
        </div>
    @endif

    <form method="GET" action="{{ route('admin.galeri.index') }}" class="mb-6">
        <div class="flex gap-3 items-end">
            <div class="min-w-48">
                <label for="is_active" class="block font-label-sm text-on-surface mb-2">Status Aktif</label>
                <select class="cms-input" id="is_active" name="is_active">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request()->input('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request()->input('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                Filter
            </button>
            <a href="{{ route('admin.galeri.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                Reset
            </a>
        </div>
    </form>

    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container text-on-surface-variant">
                    <tr>
                        <th class="px-4 py-3 text-left font-label-sm">#</th>
                        <th class="px-4 py-3 text-left font-label-sm">Nama Galeri</th>
                        <th class="px-4 py-3 text-left font-label-sm">Status Aktif</th>
                        <th class="px-4 py-3 text-center font-label-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @if(empty($galleries) || $galleries->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-on-surface-variant">Belum ada data galeri.</td>
                        </tr>
                    @else
                        @php
                        $no = 1 + ($galleries->currentPage() - 1) * $galleries->perPage();
                        @endphp
                        @foreach($galleries as $gallery)
                        <tr class="hover:bg-surface-container/50 transition-colors">
                            <td class="px-4 py-3 text-on-surface-variant">{{ $no++ }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($gallery->gambar && file_exists(public_path('storage/'.$gallery->gambar)))
                                        <img src="{{ asset('storage/'.$gallery->gambar) }}" class="w-10 h-10 rounded object-cover" alt="{{ $gallery->nama }}">
                                    @endif
                                    <span class="text-on-surface">{{ $gallery->nama }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($gallery->is_active == 1)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-success/10 text-success">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.galeri.show', $gallery->id) }}" class="text-info hover:text-info/80 transition-colors" title="Lihat Detail">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                    </a>
                                    @can('admin', 'bendahara')
                                    <a href="{{ route('admin.galeri.edit', $gallery->id) }}" class="text-primary hover:text-primary/80 transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.galeri.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-error hover:text-error/80 transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @if($galleries->hasPages())
        <div class="mt-6">
            {{ $galleries->links() }}
        </div>
    @endif
</div>
@endsection