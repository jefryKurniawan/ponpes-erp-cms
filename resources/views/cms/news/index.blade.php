@extends('layouts.cms')

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">Berita & Kegiatan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
            </ol>
        </nav>
    </div>
</section>

<!-- News Content -->
<section class="news-content py-5">
    <div class="container">
        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('cms.news.index') }}" method="GET" class="input-group">
                    <input type="text" class="form-control" placeholder="Cari berita..." name="q" value="{{ request()->get('q') }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search me-2"></i></button>
                </form>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('cms.psb') }}" class="btn btn-outline-primary">
                    <i class="fas fa-graduation-cap me-2"></i> Pendaftaran Santri Baru
                </a>
            </div>
        </div>

        @if($posts->isNotEmpty())
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="news-card h-100 shadow-sm border-0 hover-lift decorative-border">
                    @if($post->featured_image)
                    <div class="news-image">
                        <img src="{{ asset('storage/'.$post->featured_image) }}" alt="{{ $post->judul }}" class="img-fluid rounded-top" loading="lazy">
                    </div>
                    @endif
                    <div class="news-content p-4">
                        <span class="news-category badge bg-primary mb-2">
                            {{ $post->category->nama ?? 'Umum' }}
                        </span>
                        <h3 class="news-title h5">
                            <a href="{{ route('cms.news.show', $post->slug) }}">{{ $post->judul }}</a>
                        </h3>
                        <p class="news-excerpt text-muted mb-3">
                            {{ Str::limit(strip_tags($post->isi), 120) }}
                        </p>
                        <div class="news-meta d-flex justify-content-between align-items-top">
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1 h-4 w-4"></i>
                                    {{ $post->published_at ?->format('d F Y') }}
                                </small>
                            </div>
                            <a href="{{ route('cms.news.show', $post->slug) }}" class="btn-link">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $posts->links() }}
        </div>
        @else
        <div class="alert alert-info">
            Belum ada berita yang dipublikasikan.
        </div>
        @endif
    </div>
</section>
@endsection