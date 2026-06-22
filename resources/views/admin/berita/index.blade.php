@extends('layouts.admin')
@section('title', 'Data Berita')
@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-headline-md text-headline-md text-on-surface">Data Berita</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola berita dan pengumuman pesantren</p>
                </div>
                @can('admin', 'bendahara')
                <a href="{{ route('admin.berita.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Tambah Berita
                </a>
                @endcan
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-success bg-success-container/10 p-4">
                <p class="font-body-sm text-success">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-lg border border-error bg-error-container/10 p-4">
                <p class="font-body-sm text-error">{{ session('error') }}</p>
            </div>
        @endif

        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-surface-container text-on-surface-variant">
                        <tr>
                            <th class="px-4 py-3 text-left font-label-sm">#</th>
                            <th class="px-4 py-3 text-left font-label-sm">Judul</th>
                            <th class="px-4 py-3 text-left font-label-sm">Kategori</th>
                            <th class="px-4 py-3 text-left font-label-sm">Status</th>
                            <th class="px-4 py-3 text-left font-label-sm">Tanggal Publikasi</th>
                            <th class="px-4 py-3 text-center font-label-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @if(empty($posts) || $posts->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada data berita.</td>
                            </tr>
                        @else
                            @php
                            $no = 1 + ($posts->currentPage() - 1) * $posts->perPage();
                            @endphp
                            @foreach($posts as $post)
                            <tr class="hover:bg-surface-container/50 transition-colors">
                                <td class="px-4 py-3 text-on-surface-variant">{{ $no++ }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        @if($post->featured_image && file_exists(public_path('storage/'.$post->featured_image)))
                                            <img src="{{ asset('storage/'.$post->featured_image) }}" class="w-10 h-10 rounded object-cover" alt="{{ $post->judul }}">
                                        @endif
                                        <span class="text-on-surface font-medium">{{ $post->judul }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($post->category)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">{{ $post->category->name }}</span>
                                    @else
                                        <span class="text-on-surface-variant">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @switch($post->status)
                                        @case('draft')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-warning/10 text-warning">Draft</span>
                                            @break
                                        @case('published')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-success/10 text-success">Published</span>
                                            @break
                                        @case('archived')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">Archived</span>
                                            @break
                                        @default
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">{{ $post->status }}</span>
                                    @endswitch
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.berita.show', $post->id) }}" class="text-info hover:text-info/80 transition-colors" title="Lihat Detail">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                        </a>
                                        @can('admin', 'bendahara')
                                        <a href="{{ route('admin.berita.edit', $post->id) }}" class="text-primary hover:text-primary/80 transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $post->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-error hover:text-error/80 transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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

        @if($posts->hasPages())
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</main>
@endsection