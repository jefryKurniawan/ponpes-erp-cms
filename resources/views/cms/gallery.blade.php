@extends('layouts.cms')

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">Galeri Foto</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cms.gallery') }}">Galeri Foto</a></li>
                <li class="breadcrumb-item active" aria-current="page">Galeri Foto</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Gallery -->
<section class="gallery py-5">
    <div class="container">
        <div class="row">
            <!-- Filter & Search -->
            <div class="col-12 mb-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari galeri..." id="gallerySearch">
                    <button class="btn btn-outline-secondary" type="button" id="gallerySearchBtn"><x-heroicon-o-magnifying-glass class="me-2 h-4 w-4"/></button>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach($galleryImages as $gallery)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="gallery-item hover-lift">
                    <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->title }}" class="img-fluid rounded gallery-img">
                    <div class="gallery-overlay">
                        <h3>{{ $gallery->title }}</h3>
                        <p class="gallery-description">{{ $gallery->description }}</p>
                        <a href="{{ asset($gallery->image_path) }}" target="_blank" class="btn btn-primary btn-sm">
                            <x-heroicon-o-arrows-expand class="ms-2 h-4 w-4"/> Lihat Fullsize
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Simple gallery search/filter
    document.addEventListener('DOMContentLoaded', function() {
        const searchBtn = document.getElementById('gallerySearchBtn');
        const searchInput = document.getElementById('gallerySearch');

        searchBtn.addEventListener('click', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const galleryItems = document.querySelectorAll('.gallery-item');

            galleryItems.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const description = item.querySelector('.gallery-description').textContent.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Allow Enter key to trigger search
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    });
</script>
@endpush