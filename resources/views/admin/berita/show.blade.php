@extends('layouts.admin')

@section('title', $post->judul . ' | Admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">{{ $post->judul }}</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Detail informasi berita</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.berita.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                    Kembali
                </a>
                @can('admin', 'bendahara')
                <a href="{{ route('admin.berita.edit', $post->id) }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
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

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="md:col-span-1">
            <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Thumbnail</h3>
                @if($post->featured_image && file_exists(public_path('storage/'.$post->featured_image)))
                    <img src="{{ asset('storage/'.$post->featured_image) }}" class="w-full rounded-lg" alt="Thumbnail">
                @else
                    <div class="bg-surface-container rounded-lg p-8 text-center">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/50 mb-2">image</span>
                        <p class="text-on-surface-variant text-sm">Tidak ada thumbnail</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
                <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between py-2 border-b border-outline-variant/10">
                        <dt class="font-label-sm text-on-surface-variant">Kategori</dt>
                        <dd>
                            @if($post->category)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">{{ $post->category->name }}</span>
                            @else
                                <span class="text-on-surface-variant">-</span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-outline-variant/10">
                        <dt class="font-label-sm text-on-surface-variant">Status</dt>
                        <dd>
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
                        </dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-outline-variant/10">
                        <dt class="font-label-sm text-on-surface-variant">Tanggal Pembuatan</dt>
                        <dd class="text-on-surface">{{ $post->created_at ? $post->created_at->format('d M Y H:i') : '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-outline-variant/10">
                        <dt class="font-label-sm text-on-surface-variant">Tanggal Publikasi</dt>
                        <dd class="text-on-surface">{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</dd>
                    </div>
                    <div class="flex justify-between py-2 border-b border-outline-variant/10">
                        <dt class="font-label-sm text-on-surface-variant">Slug</dt>
                        <dd class="text-on-surface">{{ $post->slug ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Isi Berita</h3>
        <div class="prose prose-slate max-w-none">
            {!! nl2br(e($post->isi)) !!}
        </div>
    </div>
</div>
@endsection