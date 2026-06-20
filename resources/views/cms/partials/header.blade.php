<!-- Header for CMS pages -->
<nav class="fixed top-0 w-full z-50 bg-surface/95 backdrop-blur-md border-b border-secondary/10 shadow-sm">
  <div class="flex justify-between items-center h-20 px-gutter max-w-7xl mx-auto">
    <!-- Logo / Brand clickable -->
    <a href="{{ route('cms.home') }}" class="font-headline-sm text-headline-sm text-primary flex items-center gap-2">
      <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">mosque</span>
      Al-Hikmah Pesantren
    </a>
    <!-- Navigation links -->
    <div class="hidden md:flex items-center gap-lg">
      <a class="{{ request()->is('tentang-kami') || request()->is('about') ? 'text-primary border-b-2 border-primary pb-1' : 'font-body-md text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('cms.about') }}">Tentang Kami</a>
      <a class="{{ request()->is('program') ? 'text-primary border-b-2 border-primary pb-1' : 'font-body-md text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('cms.program') }}">Program</a>
      <a class="{{ request()->is('pendaftaran') ? 'text-primary border-b-2 border-primary pb-1' : 'font-body-md text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('cms.pendaftaran') }}">Pendaftaran</a>
      <a class="{{ request()->is('galeri') || request()->is('gallery') ? 'text-primary border-b-2 border-primary pb-1' : 'font-body-md text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('cms.gallery') }}">Galeri</a>
      <a class="{{ request()->is('kontak') ? 'text-primary border-b-2 border-primary pb-1' : 'font-body-md text-on-surface-variant hover:text-primary transition-colors' }}" href="{{ route('cms.kontak') }}">Kontak</a>
    </div>
    <a href="{{ route('login') }}" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md scale-95 active:scale-90 transition-transform shadow-md hover:bg-primary-container inline-block text-center">
      Portal Santri
    </a>
  </div>
</nav>
