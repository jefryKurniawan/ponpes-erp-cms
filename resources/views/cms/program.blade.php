@extends('layouts.cms')

@section('title', $settings ? $settings->nama_pesantren.' - Program' : 'Program Al‑Hikmah Pesantren')
@section('description', 'Informasi program pendidikan dan kegiatan di Al‑Hikmah Pesantren')
@section('og_title', $settings ? $settings->nama_pesantren.' - Program' : 'Program Al‑Hikmah Pesantren')
@section('og_description', 'Lihat detail program belajar, kegiatan ekstrakurikuler, dan inisiatif lainnya.')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_title', $settings ? $settings->nama_pesantren.' - Program' : 'Program Al‑Hikmah Pesantren')
@section('twitter_description', 'Lihat detail program belajar, kegiatan ekstrakurikuler, dan inisiatif lainnya.')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
<div class="max-w-7xl mx-auto px-gutter py-32">
  <header class="text-center mb-12">
    <h1 class="font-headline-lg text-headline-lg text-primary">Program Unggulan</h1>
    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">
      Menawarkan berbagai program pendidikan, pengembangan diri, dan aktivitas keagamaan yang dirancang untuk membentuk santri berkarakter kuat.
    </p>
  </header>
  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
    <!-- Example program cards (static placeholders) -->
    <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border-t-4 border-primary">
      <h2 class="font-headline-md text-headline-md text-primary mb-4">Kurikulum Kitab Kuning</h2>
      <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
        Pendalaman ilmu agama klasik melalui pengajaran teks kitab kuning dengan metode sorogan dan diskusi.
      </p>
    </div>
    <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border-t-4 border-secondary">
      <h2 class="font-headline-md text-headline-md text-secondary mb-4">Tahfidz Al‑Qur'an</h2>
      <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
        Program intensif hafalan Al‑Qur'an untuk semua tingkatan usia, didukung guru berpengalaman.
      </p>
    </div>
    <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border-t-4 border-tertiary">
      <h2 class="font-headline-md text-headline-md text-tertiary mb-4">Ekstrakurikuler</h2>
      <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">
        Beragam kegiatan seperti seni, olahraga, teknologi, dan kepemudaan untuk menumbuhkan kreativitas.
      </p>
    </div>
  </section>
</div>
@endsection
