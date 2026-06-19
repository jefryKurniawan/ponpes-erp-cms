@extends('layouts.home')

@section('title_page', $post->judul)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $post->judul }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary">Kembali ke Daftar</a>
            @can('admin' , 'bendahara')
            <a href="{{ route('admin.berita.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
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
        <div class="col-md-4">
            @if($post->thumbnail && file_exists(public_path('storage/'.$post->thumbnail)))
                <img src="{{ asset('storage/'.$post->thumbnail) }}" class="img-fluid rounded" alt="Thumbnail">
            @else
                <div class="bg-light p-4 text-center rounded">
                    <i class="bi bi-image fs-1 text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada thumbnail</p>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <dl class="row">
                <dt class="col-sm-3">Kategori</dt>
                <dd class="col-sm-9">
                    @if($post->category)
                        <span class="badge bg-secondary">{{ $post->category->nama }}</span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    @switch($post->status)
                        @case('draft')
                            <span class="badge bg-warning text-dark">Draft</span>
                            @break
                        @case('published')
                            <span class="badge bg-success">Published</span>
                            @break
                        @case('archived')
                            <span class="badge bg-secondary">Archived</span>
                            @break
                        @default
                            <span class="badge bg-light text-dark">{{ $post->status }}</span>
                    @endswitch
                </dd>

                <dt class="col-sm-3">Tanggal Pembuatan</dt>
                <dd class="col-sm-9">{{ $post->created_at ? $post->created_at->format('d M Y H:i') : '-' }}</dd>

                <dt class="col-sm-3">Tanggal Publikasi</dt>
                <dd class="col-sm-9">{{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}</dd>

                <dt class="col-sm-3">Slug</dt>
                <dd class="col-sm-9">{{ $post->slug ?? '-' }}</dd>
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Isi Berita</h5>
        </div>
        <div class="card-body">
            {!! $post->isi !!} {!! nl2br(e($post->isi)) !!}
        </div>
    </div>
</div>
@endsection