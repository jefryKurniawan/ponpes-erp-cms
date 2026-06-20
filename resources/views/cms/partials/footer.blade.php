<footer class="bg-surface-container-low dark:bg-inverse-surface py-12 border-t border-secondary/10">
  <div class="max-w-7xl mx-auto px-gutter grid grid-cols-1 md:grid-cols-4 gap-lg">
    <!-- About Section -->
    <div>
      <h4 class="font-headline-sm text-headline-sm text-primary mb-4">Tentang Pesantren</h4>
      <p class="font-body-sm text-body-sm text-on-surface-variant">
        Pesantren adalah lembaga pendidikan Islam yang fokus pada pengajaran Al‑Qur'an dan Hadis, serta pengembangan karakter santri berdasarkan nilai‑nilai keislaman yang luhur.
      </p>
    </div>
    <!-- Navigation -->
    <div>
      <h4 class="font-headline-sm text-headline-sm text-primary mb-4">Navigasi</h4>
      <ul class="space-y-2">
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="{{ route('cms.home') }}">Beranda</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="{{ route('cms.about') }}">Tentang Kami</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="{{ route('cms.news.index') }}">Berita</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="{{ route('cms.psb') }}">Pendaftaran</a></li>
      </ul>
    </div>
    <!-- Layanan -->
    <div>
      <h4 class="font-headline-sm text-headline-sm text-primary mb-4">Layanan</h4>
      <ul class="space-y-2">
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="#">Program Hafalan Qur'an</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="#">Kelas Bahasa Arab</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="#">Pengajian Keluarga</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="#">Konseling Santri</a></li>
        <li><a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary" href="#">Program Beasiswa</a></li>
      </ul>
    </div>
    <!-- Social & Contact -->
    <div>
      <h4 class="font-headline-sm text-headline-sm text-primary mb-4">Hubungi Kami</h4>
      <div class="space-y-2 text-body-sm text-on-surface-variant">
        <p class="flex items-start gap-2">
          <span class="material-symbols-outlined text-[16px] shrink-0" style="font-variation-settings: 'FILL' 0">place</span>
          <span>Desa Pesantren, Kabupaten XXX</span>
        </p>
        <p class="flex items-center gap-2">
          <span class="material-symbols-outlined text-[16px] shrink-0" style="font-variation-settings: 'FILL' 0">call</span>
          <span>+62 812-3456-7890</span>
        </p>
        <p class="flex items-center gap-2">
          <span class="material-symbols-outlined text-[16px] shrink-0" style="font-variation-settings: 'FILL' 0">mail</span>
          <span>info@pesantren.example.com</span>
        </p>
      </div>
    </div>
  </div>
  <div class="border-t border-secondary/10 mt-8 pt-4 text-center">
    <p class="font-body-sm text-body-sm text-on-surface-variant">
      Pesantren CMS &copy; {{ date('Y') }}. All Rights Reserved.
    </p>
  </div>
</footer>