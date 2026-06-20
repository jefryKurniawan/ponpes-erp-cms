@extends('layouts.cms')

@section('title', $settings ? $settings->nama_pesantren.' - Galeri' : 'Galeri Al‑Hikmah Pesantren')
@section('description', 'Galeri foto dan video kegiatan Al‑Hikmah Pesantren')
@section('og_title', $settings ? $settings->nama_pesantren.' - Galeri' : 'Galeri Al‑Hikmah Pesantren')
@section('og_description', 'Lihat koleksi foto dan video kegiatan Al‑Hikmah Pesantren')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_title', $settings ? $settings->nama_pesantren.' - Galeri' : 'Galeri Al‑Hikmah Pesantren')
@section('twitter_description', 'Lihat koleksi foto dan video kegiatan Al‑Hikmah Pesantren')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
  <div class="max-w-7xl mx-auto px-gutter py-32 relative z-10">
    <!-- Header -->
    <header class="mb-12 text-center md:text-left">
      <div class="inline-block bg-secondary-fixed text-on-secondary-fixed-variant px-4 py-1 rounded-full font-label-sm mb-4">Galeri Kegiatan</div>
      <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Galeri Kehidupan Pesantren</h1>
      <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl italic">
        Menyaksikan harmoni antara tradisi keilmuan Islam, kearifan lokal, dan fasilitas modern yang menunjang tumbuh kembang santri.
      </p>
    </header>

    <!-- Category Filter -->
    <section class="mb-8 flex flex-wrap gap-2 justify-center md:justify-start sticky top-24 z-40 bg-surface/50 backdrop-blur-md py-2 rounded-xl px-2">
      <button class="filter-btn active bg-primary text-on-primary px-4 py-1 rounded-full font-label-md" data-category="all">Semua</button>
      <button class="filter-btn bg-surface-container-lowest text-on-surface-variant px-4 py-1 rounded-full font-label-md" data-category="fasilitas">Fasilitas</button>
      <button class="filter-btn bg-surface-container-lowest text-on-surface-variant px-4 py-1 rounded-full font-label-md" data-category="kegiatan">Kegiatan</button>
      <button class="filter-btn bg-surface-container-lowest text-on-surface-variant px-4 py-1 rounded-full font-label-md" data-category="prestasi">Prestasi</button>
    </section>

    <!-- Masonry Grid -->
    <div class="columns-1 sm:columns-2 lg:columns-3 gap-6" id="gallery-grid">
      @foreach($galleryImages as $img)
      <div class="gallery-card masonry-item group relative overflow-hidden rounded-xl bg-surface-container-lowest shadow-sm border border-divider-clay" data-category="{{ $img->category ?? 'unknown' }}">
        <div class="aspect-[4/5] overflow-hidden">
          <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ $img->url ?? $img->path }}" alt="{{ $img->caption ?? '' }}"/>
        </div>
        <div class="caption-overlay absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/40 to-transparent opacity-0 translate-y-4 transition-all duration-300 flex flex-col justify-end p-6">
          <span class="font-label-sm text-label-sm text-tertiary-fixed mb-1 uppercase tracking-widest">{{ ucfirst($img->category ?? 'Galeri') }}</span>
          <h3 class="font-headline-sm text-on-primary text-headline-sm leading-tight">{{ $img->title ?? 'Foto Galeri' }}</h3>
          <p class="text-on-primary/80 font-body-sm mt-2">{{ $img->description ?? '' }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Load More CTA -->
    <div class="mt-12 text-center">
      <button class="cms-btn group relative overflow-hidden bg-surface-container-lowest text-primary border-2 border-primary px-8 py-2 rounded-lg font-label-md hover:text-on-primary transition-all duration-500">
        <span class="relative z-10">Lihat Lebih Banyak Koleksi</span>
        <div class="absolute inset-0 bg-primary translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
      </button>
    </div>
  </div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-card');
    filterButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        const category = btn.getAttribute('data-category');
        filterButtons.forEach(b => {
          b.classList.remove('active', 'bg-primary', 'text-on-primary');
          b.classList.add('bg-surface-container-lowest', 'text-on-surface-variant');
        });
        btn.classList.add('active', 'bg-primary', 'text-on-primary');
        btn.classList.remove('bg-surface-container-lowest', 'text-on-surface-variant');
        galleryItems.forEach(item => {
          item.style.transition = 'all 0.4s cubic-bezier(0.4,0,0.2,1)';
          if (category === 'all' || item.dataset.category === category) {
            item.style.opacity = '1';
            item.style.transform = 'scale(1)';
            setTimeout(() => { item.style.display = 'block'; }, 50);
          } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.95)';
            setTimeout(() => { item.style.display = 'none'; }, 400);
          }
        });
      });
    });
  });
</script>
@endsection