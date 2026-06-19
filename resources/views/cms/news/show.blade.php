@extends('layouts.cms')

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">{{ $post->judul }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cms.news.index') }}">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $post->judul }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- News Detail -->
<section class="news-detail py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                @if($post->thumbnail)
                <div class="news-image mb-4 hover-lift decorative-border">
                    <img src="{{ asset('storage/'.$post->thumbnail) }}" alt="{{ $post->judul }}" class="img-fluid rounded shadow-sm" loading="lazy">
                </div>
                @endif

                <div class="news-meta mb-4">
                    <span class="news-date">
                        <x-heroicon-o-calendar class="me-1 h-4 w-4"/>
                        {{ $post->published_at ?->format('d F Y') }}
                    </span>
                    @if($post->category)
                    <span class="news-category ms-3">
                        <x-heroicon-o-tag class="me-1 h-4 w-4"/>
                        {{ $post->category->nama }}
                    </span>
                    @endif
                </div>

                <div class="news-content">
                    {!! $post->isi !!}
                </div>

                @if($post->tags && $post->tags->isNotEmpty())
                <div class="news-tags mt-4 pt-3 border-top">
                    <span class="me-2"><strong>Tags:</strong></span>
                    @foreach($post->tags as $tag)
                    <span class="badge bg-light text-dark me-2 mb-1">{{ $tag->nama }}</span>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 ms-lg-5">
                <!-- Related News -->
                @if($relatedPosts->isNotEmpty())
                <div class="related-news mb-5">
                    <h3 class="sidebar-title">Berita Terkait</h3>
                    <div class="related-items">
                        @foreach($relatedPosts as $related)
                        <div class="related-item mb-3 p-3 bg-light rounded hover-lift">
                            <h4 class="related-title h6">
                                <a href="{{ route('cms.news.show', $related->slug) }}">{{ $related->judul }}</a>
                            </h4>
                            <small class="text-muted">
                                <x-heroicon-o-calendar class="me-1 h-4 w-4"/>
                                {{ $related->tanggal_publishiran ?->format('d M Y') }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Newsletter Subscription -->
                <div class="newsletter mb-5">
                    <h3 class="sidebar-title">Berita Terbaru via Email</h3>
                    <p class="mb-3">
                        Dapatkan notifikasi berita terbaru langsung ke email Anda.
                    </p>
                    <form action="#" method="POST" class="newsletter-form">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Masukkan email Anda" name="email" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection