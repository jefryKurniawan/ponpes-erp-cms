@extends('layouts.cms')

@section('title', 'Tentang Kami')
@section('description', 'Informasi tentang Visi, Misi, dan Sejarah Pesantren')
@section('og_title', 'Tentang Kami')
@section('og_description', 'Informasi tentang Visi, Misi, dan Sejarah Pesantren')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_title', 'Tentang Kami')
@section('twitter_description', 'Informasi tentang Visi, Misi, dan Sejarah Pesantren')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
<!-- TopNavBar -->
@include('cms.partials.header')
<main class="pt-20">
  <!-- Hero Section -->
  <section class="relative min-h-[614px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
      <div class="absolute inset-0 bg-primary/20 mix-blend-multiply z-10"></div>
      <div class="w-full h-full bg-cover bg-center scale-105" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAF54KlGTu3VR6VizyLpxmdTj7BbW_08oCvszFNk4lEu3b-UlMe3H0ezPBlbdThbsyqJkhxjymQ5li6CxB9D0Ka8ZmUk6pUpxPGdEeYP9QyPbn9zz1nrgQfnqGHZ2xLrHzidnxNPlE0n2AS08nODf4hWCKv0kqaG9ORR6vdlRnH47OK1JB6bpWM45KS8TItrW8yzcI2Z7sOmg1n_JWjxkIc3EZiNaIhBzepUHKxsLxeJOCOr8oqg2G-WYiYZ5hX5Xwcw-GBSLnf64lf')"></div>
    </div>
    <div class="relative z-20 text-center px-gutter max-w-4xl">
      <h1 class="font-headline-lg text-headline-lg text-white mb-4 drop-shadow-lg">Meniti Cahaya, Merajut Akhlakul Karimah</h1>
      <p class="font-body-lg text-body-lg text-white/90 max-w-2xl mx-auto italic">"Pendidikan yang berakar pada tradisi, berbuah pada inovasi, dan berlandaskan pada keikhlasan."</p>
    </div>
  </section>
  <!-- History Section -->
  <section class="py-xl px-gutter max-w-7xl mx-auto relative">
    <div class="absolute inset-0 cms-pattern-bg pointer-events-none"></div>
    <div class="flex flex-col md:flex-row gap-lg mb-xl items-center">
      <div class="w-full md:w-1/2">
        <span class="text-secondary font-label-md tracking-widest block mb-2">SEJARAH KAMI</span>
        <h2 class="font-headline-md text-headline-md text-on-surface mb-6">Satu Dekade Mengabdi untuk Umat</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mb-4 leading-relaxed">
          Didirikan pada tahun 2014, Al-Hikmah Pesantren bermula dari sebuah gazebo sederhana di pinggiran kota. Di bawah bimbingan K.H. Ahmad Shodiq, pesantren ini lahir dari kegelisahan akan perlunya wadah pendidikan Islam yang mampu menjawab tantangan modernitas tanpa kehilangan jati diri salafus shalih.
        </p>
        <p class="font-body-md text-body-md text-on-surface-variant mb-4 leading-relaxed">
          Melalui dedikasi para pendidik dan dukungan masyarakat, Al-Hikmah bertransformasi dari sekumpulan santri mukim menjadi institusi pendidikan terintegrasi yang kini mendidik lebih dari 1.000 santri dari berbagai penjuru nusantara.
        </p>
      </div>
      <div class="w-full md:w-1/2 grid grid-cols-2 gap-4">
        <div class="cms-asymmetric-card overflow-hidden h-64 shadow-lg border-t-4 border-primary">
          <img class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4dcDHQ2dHQ_Bac1P-xBO0MGgCP6_Gua4TK1vwASk7TVox3stKRU9iNgItTT-ZUFevgJL1lJ0I7VPOnG4ySxYo2ChWF9f9qKjkWjCBAWtmW9W4g7RDPW0GXjYky6oALBIdo3BNeB2X6rAcIS3y-binOSNCanZO-Nye-eqsjD8Ax4XME9Cs1VhH7y9tRXdr4MC2uaqPkldIOz13U9UuoLVFPAKDoEkrVFo6n7YLiFixB2Kaw2pX0QGLtWVNodT107L4gldaOrZQoE" alt="History image 1">
        </div>
        <div class="cms-asymmetric-card overflow-hidden h-64 mt-8 shadow-lg border-t-4 border-secondary">
          <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQrAPlgVH5Cg3Cww-3kAXMHcAH-IWWlA5SrhTCWo5GdGcgyUrd8arTrzqLJAX5HVyP7x2IOhyrB1CURYTN8Y4Qe7xAStATmn6T2DRJWh46PXowxUJ4WT3x0J1AageRvBERPOIfv3Ii8zmDXJUMSMj6xg2sNMoq7q2vJ9kPKGAlZubS1FS3guLjybs3lh25EvPLIAJL6CpzMQwdKbxLDH2o0IAFrqWlRgBK4EFydNgEsNo5Pw-GSrJDLbfj1StCeqVquQHN6E-0WGHC" alt="History image 2">
        </div>
      </div>
    </div>
  </section>
  <!-- Vision & Mission -->
  <section class="bg-surface-container-low py-xl relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-gutter grid grid-cols-1 md:grid-cols-2 gap-xl relative z-10">
      <div class="p-lg bg-white/40 backdrop-blur-sm rounded-xl border border-divider-clay shadow-sm">
        <div class="flex items-center gap-4 mb-6">
          <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">visibility</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-primary">Visi</h3>
        </div>
        <p class="font-headline-sm text-headline-sm text-on-surface-variant leading-snug italic">
          "Terwujudnya generasi Qur'ani yang berwawasan global, berkepribadian mulia, dan kompeten dalam memimpin perubahan umat."
        </p>
      </div>
      <div class="p-lg bg-white/40 backdrop-blur-sm rounded-xl border border-divider-clay shadow-sm">
        <div class="flex items-center gap-4 mb-6">
          <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">task_alt</span>
          </div>
          <h3 class="font-headline-md text-headline-md text-secondary">Misi</h3>
        </div>
        <ul class="space-y-4">
          <li class="flex gap-4"><span class="text-primary font-bold">01.</span><p class="font-body-md text-on-surface-variant">Menanamkan aqidah ahlu sunnah wal jama'ah dan kecintaan terhadap tradisi keilmuan Islam.</p></li>
          <li class="flex gap-4"><span class="text-primary font-bold">02.</span><p class="font-body-md text-on-surface-variant">Menyelenggarakan pendidikan tahfidz Al-Qur'an dan kajian kitab kuning yang komprehensif.</p></li>
          <li class="flex gap-4"><span class="text-primary font-bold">03.</span><p class="font-body-md text-on-surface-variant">Mengintegrasikan literasi digital dan keterampilan abad-21 dalam kurikulum pesantren.</p></li>
        </ul>
      </div>
    </div>
    <div class="absolute -bottom-24 -right-24 opacity-5 pointer-events-none">
      <span class="material-symbols-outlined text-[300px]" style="font-variation-settings: 'wght' 100;">clean_hands</span>
    </div>
  </section>
  <!-- Leadership Section -->
  <section class="py-xl px-gutter max-w-7xl mx-auto">
    <div class="text-center mb-16">
      <h2 class="font-headline-lg text-headline-lg text-primary mb-2">Dewan Pengasuh</h2>
      <p class="font-body-md text-on-surface-variant italic">Membimbing dengan Hati, Mendidik dengan Keteladanan</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
      <!-- Leader 1 -->
      <div class="group">
        <div class="relative mb-6 overflow-hidden rounded-xl shadow-lg border-b-8 border-primary/20 transition-all duration-500 hover:-translate-y-2">
          <div class="aspect-[3/4]">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuArHrnbNgt74Y_LHvbnkWlYniQ-W6BBYu0NvYcfuJNX-fL7OrSBjNqO0j3ktp6jrBaJ_gnXzoCbgTuGF5X7BAKuMJefTD93janxEGP7ZowvoIalR5nVTB71lNtXbYu-KWRGge_KMVYSz6jMpjMJgjzBVaor8NB4EXci9mNn9BQd6E0CqT4pX5aqBag503tFl76LmMJ6CnkMPz3vMcyhM-vwKps3PJHNDanNIwIwTLh1GHkfU5AyxvlKRaovQIeyMd_Uxy2OpV3XfCeb" alt="Leader 1">
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <p class="text-white font-body-sm italic">"Pendidikan bukan sekadar transfer pengetahuan, tapi transfer keberkahan."</p>
          </div>
        </div>
        <h4 class="font-headline-sm text-headline-sm text-on-surface text-center">K.H. Ahmad Shodiq</h4>
        <p class="font-label-md text-primary text-center uppercase tracking-widest">Pengasuh Utama</p>
      </div>
      <!-- Leader 2 -->
      <div class="group mt-12 md:mt-0">
        <div class="relative mb-6 overflow-hidden rounded-xl shadow-lg border-b-8 border-secondary/20 transition-all duration-500 hover:-translate-y-2">
          <div class="aspect-[3/4]">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA-CtG9lzDY40cwQdeFPuSqwakU3IP5u6YIg7JSpkeoZWt61D2rMAtHeIs9z2QSgDkOzPapqJ4pxCvZ_2ner2-_g2WwQbfGY1vk1PdGgACSHZ_rz0ZFpmsNDDJiE6jWMOn__feFSE2bFE3vrsyADbKZPgC0N3Br6qRwxcM1d4_eD8mi9uApiTKGl7dYbZiYeYQkpZVD0RahAFmTVop-kSIK5W8cHl0NGMVzAhj2LjYB20zbR090m9uDr_vLtKIfyeXfu17CFS6vdDIC" alt="Leader 2">
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-secondary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <p class="text-white font-body-sm italic">"Membangun karakter santriwati yang mandiri dan berilmu luas."</p>
          </div>
        </div>
        <h4 class="font-headline-sm text-headline-sm text-on-surface text-center">Nyai Hj. Siti Aminah</h4>
        <p class="font-label-md text-secondary text-center uppercase tracking-widest">Kepala Santri Putri</p>
      </div>
      <!-- Leader 3 -->
      <div class="group">
        <div class="relative mb-6 overflow-hidden rounded-xl shadow-lg border-b-8 border-tertiary/20 transition-all duration-500 hover:-translate-y-2">
          <div class="aspect-[3/4]">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDgr0jYR8NaecBBQo4bTJ8DMu6fv8KT4cKLsguyTRS49y1zq0MbeNQYInUp01tuWDw8nn4Lcx2HgiM4pOW5yxGzoJbRjJ-JaJK6QpLscr22miKbOumWZZ2NSV4Nqwb1xjUeS-CqUDXcMkT7l4PBPpymkC_ad_ry_5OnZ3yfjk5rhpLF96bdfn2iuvtReulx0194X0S7sOtnAtFZIoyIpTKumjWEXKINF6uaBdH6fyWkg7qaIM68j08-mbX0KSpvD5JcJsznDHCMiyrd" alt="Leader 3">
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-tertiary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <p class="text-on-tertiary-container font-body-sm italic">"Mengintegrasikan teknologi ke dalam dakwah santri milenial."</p>
          </div>
        </div>
        <h4 class="font-headline-sm text-headline-sm text-on-surface text-center">Ustadz M. Farhan, M.Pd</h4>
        <p class="font-label-md text-tertiary text-center uppercase tracking-widest">Direktur Akademik</p>
      </div>
    </div>
  </section>
  <!-- CTA Section -->
  <section class="py-xl px-gutter">
    <div class="max-w-5xl mx-auto bg-primary rounded-2xl p-lg md:p-xl text-center text-white relative overflow-hidden shadow-2xl">
      <div class="cms-pattern-bg absolute inset-0 opacity-10"></div>
      <div class="relative z-10">
        <h2 class="font-headline-md text-headline-md mb-4">Mari Menjadi Bagian dari Keluarga Al-Hikmah</h2>
        <p class="font-body-md mb-8 max-w-2xl mx-auto opacity-90">Daftarkan putra-putri Anda sekarang untuk mendapatkan pendidikan yang menyeimbangkan antara ilmu duniawi dan ukhrawi.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="bg-white text-primary px-8 py-3 rounded-lg font-label-md shadow-md hover:bg-surface-variant transition-colors">Daftar Sekarang</button>
          <button class="border border-white/40 text-white px-8 py-3 rounded-lg font-label-md hover:bg-white/10 transition-colors">Unduh Brosur</button>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

@section('script')
<script>
        // Micro-interactions and subtle scroll effects
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-md');
                nav.classList.replace('h-20', 'h-16');
            } else {
                nav.classList.remove('shadow-md');
                nav.classList.replace('h-16', 'h-20');
            }
        });
        // Hover effect for leader cards
        document.querySelectorAll('.group').forEach(el => {
            el.addEventListener('mouseenter', () => {
                el.querySelector('img').style.transform = 'scale(1.05)';
            });
            el.addEventListener('mouseleave', () => {
                el.querySelector('img').style.transform = 'scale(1)';
            });
        });
    </script>
@endsection