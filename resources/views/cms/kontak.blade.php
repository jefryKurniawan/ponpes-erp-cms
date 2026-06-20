@extends('layouts.cms')

{{-- Meta tags (fallback safe) --}}
@section('title', $settings ? $settings->nama_pesantren.' - Kontak' : 'Kontak Al‑Hikmah Pesantren')
@section('description', 'Informasi kontak Al‑Hikmah Pesantren – alamat, telepon, email, serta formulir kirim pesan.')
@section('og_title', $settings ? $settings->nama_pesantren.' - Kontak' : 'Kontak Al‑Hikmah Pesantren')
@section('og_description', 'Hubungi Al‑Hikmah Pesantren melalui alamat, telepon, email, atau form online.')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_title', $settings ? $settings->nama_pesantren.' - Kontak' : 'Kontak Al‑Hikmah Pesantren')
@section('twitter_description', 'Hubungi Al‑Hikmah Pesantren melalui alamat, telepon, email, atau form online.')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
<main class="pt-20">
  {{-- Hero Section --}}
  <section class="relative py-24 bg-surface-container-low overflow-hidden">
    <div class="absolute inset-0 organic-pattern"></div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-tertiary/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>
    <div class="relative max-w-7xl mx-auto px-gutter text-center">
      <nav class="mb-6 flex justify-center items-center gap-2 text-on-surface-variant font-label-sm">
        <a class="hover:text-primary" href="{{ route('cms.home') }}">Beranda</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-secondary font-bold">Kontak Kami</span>
      </nav>
      <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-primary mb-4">Hubungi Kami</h1>
      <p class="max-w-2xl mx-auto text-on-surface-variant text-body-lg">
        Mari jalin silaturahmi. Kami siap membantu menjawab pertanyaan Anda tentang program pendidikan, pendaftaran, atau kegiatan pesantren.
      </p>
    </div>
  </section>

  {{-- Contact Section --}}
  <section class="py-xl max-w-7xl mx-auto px-gutter">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-xl items-start">
      {{-- Left column – info & map --}}
      <div class="lg:col-span-5 space-y-md">
        <div class="cms-card border-t-secondary relative overflow-hidden">
          <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-secondary to-tertiary"></div>
          <h2 class="font-headline-sm text-headline-sm text-secondary mb-6">Informasi Kontak</h2>
          <div class="space-y-6">
            {{-- Alamat --}}
            <div class="flex gap-4">
              <div class="w-12 h-12 shrink-0 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined">location_on</span>
              </div>
              <div>
                <h3 class="font-label-md text-on-surface">Alamat Pesantren</h3>
                <p class="text-on-surface-variant mt-1">
                  Jl. KH. Agus Salim No. 123, Kel. Budaya, Kec. Tradisi, Kabupaten Jawa Timur, Indonesia
                </p>
              </div>
            </div>
            {{-- Telepon & WA --}}
            <div class="flex gap-4">
              <div class="w-12 h-12 shrink-0 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">call</span>
              </div>
              <div>
                <h3 class="font-label-md text-on-surface">Telepon &amp; WhatsApp</h3>
                <p class="text-on-surface-variant mt-1">+62 (21) 555‑0198<br>+62 812‑3456‑7890 (Admisi)</p>
              </div>
            </div>
            {{-- Email --}}
            <div class="flex gap-4">
              <div class="w-12 h-12 shrink-0 bg-tertiary/10 rounded-full flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined">mail</span>
              </div>
              <div>
                <h3 class="font-label-md text-on-surface">Email Resmi</h3>
                <p class="text-on-surface-variant mt-1">
                  info@alhikmah-pesantren.sch.id<br>pendaftaran@alhikmah-pesantren.sch.id
                </p>
              </div>
            </div>
          </div>
          {{-- Media Sosial --}}
          <div class="mt-8 pt-8 border-t border-divider-clay">
            <h3 class="font-label-md text-on-surface mb-4">Media Sosial</h3>
            <div class="flex gap-4">
              <a class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center hover:bg-secondary hover:text-white transition-all duration-300" href="#"><span class="material-symbols-outlined text-[20px]">public</span></a>
              <a class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center hover:bg-secondary hover:text-white transition-all duration-300" href="#"><span class="material-symbols-outlined text-[20px]">movie</span></a>
              <a class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center hover:bg-secondary hover:text-white transition-all duration-300" href="#"><span class="material-symbols-outlined text-[20px]">photo_camera</span></a>
            </div>
          </div>
        </div>

        {{-- Map placeholder --}}
        <div class="rounded-xl overflow-hidden shadow-sm h-[300px] relative group border border-outline/10">
          <div class="absolute inset-0 bg-surface-container-highest flex items-center justify-center">
            <div class="text-center p-8">
              <span class="material-symbols-outlined text-secondary text-5xl mb-4">map</span>
              <p class="font-headline-sm text-on-surface-variant">Lokasi Pesantren</p>
              <p class="text-body-sm opacity-60 mt-2">Peta Interaktif – Kabupaten Jawa Timur</p>
            </div>
          </div>
          <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
               src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoJX0Yec-Q0u1epf08IO1Nns4asQIam-0nSCj2GS3e9N0xpM1p6QAnoYB1B5IYB7DCdyUdiXpU6-VK9Nw55eVRV65jEpA-FYMii8KafgXz0rqdhHG75S-9eYUirOlK2E-fPPW__9-SYRRhd-pnsct3oXDsONlk6NDtGGnoOZpyJDXI0iHadLD-Xpv0ZuPhO6U_2Bxzod0uXDx6uh_LUX_T62YRgcDS-7OXy-YAWpFAjiI3NJ3fKJRzfUbBImqI37bwGBLotEsV24Op"
               alt="Peta Pesantren"/>
          <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur p-4 rounded-lg shadow-lg border border-primary/20">
            <button class="flex items-center gap-2 text-primary font-bold text-sm">
              <span class="material-symbols-outlined text-[18px]">directions</span>
              Buka di Google Maps
            </button>
          </div>
        </div>
      </div>

      {{-- Right column – contact form --}}
      <div class="lg:col-span-7">
        <div class="cms-card">
          <h2 class="font-headline-sm text-headline-sm text-primary mb-2">Kirim Pesan</h2>
          <p class="text-on-surface-variant mb-8 font-body-md">
            Sampaikan pesan, saran, atau pertanyaan Anda melalui formulir di bawah ini.
          </p>
          <form class="space-y-6" id="contactForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="space-y-2">
                <label class="font-label-md text-on-surface">Nama Lengkap</label>
                <div class="relative">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">person</span>
    <input class="cms-input pl-10" placeholder="Nama Lengkap" required type="text"/>
  </div>
              </div>
              <div class="space-y-2">
                <label class="font-label-md text-on-surface">Alamat Email</label>
                <div class="relative">
        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
        <input class="cms-input pl-10" placeholder="Alamat Email" required type="email" />
      </div>
              </div>
            </div>

            <div class="space-y-2">
              <label class="font-label-md text-on-surface">Subjek Pesan</label>
              <div class="relative"><span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">subject</span><select class="cms-input pl-10">
                <option value="">Pilih Subjek…</option>
                <option value="pendaftaran">Pendaftaran Santri Baru</option>
                <option value="umum">Informasi Umum</option>
                <option value="kunjungan">Permohonan Kunjungan</option>
                <option value="donasi">Informasi Wakaf/Infaq</option>
              </select></div>
            </div>

            <div class="space-y-2">
              <label class="font-label-md text-on-surface">Pesan Anda</label>
              <div class="relative">
        <span class="material-symbols-outlined absolute left-3 top-3 text-outline">message</span>
        <textarea class="cms-input pl-10 pt-10 resize-none" rows="6" placeholder="Tuliskan pesan lengkap Anda di sini…"></textarea>
      </div>
            </div>

            <div class="flex items-start gap-3">
              <input class="mt-1 rounded border-outline/30 text-primary focus:ring-primary/20" id="privacy" type="checkbox"/>
              <label class="text-body-sm text-on-surface-variant" for="privacy">
                Saya menyetujui kebijakan privasi dan memperbolehkan tim Al‑Hikmah menghubungi saya kembali.
              </label>
            </div>

            <div class="pt-4">
              <button class="cms-btn-primary w-full md:w-auto flex items-center justify-center gap-2" type="submit">
                Kirim Pesan Sekarang
                <span class="material-symbols-outlined text-[20px]">send</span>
              </button>
            </div>
          </form>
        </div>

        {{-- Bento info boxes --}}
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-primary/5 p-6 rounded-xl border border-primary/10 flex items-center gap-4">
            <span class="material-symbols-outlined text-primary text-4xl">schedule</span>
            <div>
              <p class="font-label-md text-primary">Jam Operasional Kantor</p>
              <p class="text-body-sm text-on-surface-variant">Senin‑Sabtu: 08.00‑16.00</p>
            </div>
          </div>
          <div class="bg-secondary/5 p-6 rounded-xl border border-secondary/10 flex items-center gap-4">
            <span class="material-symbols-outlined text-secondary text-4xl">verified_user</span>
            <div>
              <p class="font-label-md text-secondary">Layanan Terpadu</p>
              <p class="text-body-sm text-on-surface-variant">Respon cepat dalam 1 × 24 jam</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA Section --}}
  <section class="py-xl bg-surface-container-highest relative overflow-hidden">
    <div class="absolute inset-0 batik-overlay"></div>
    <div class="relative max-w-4xl mx-auto px-gutter text-center">
      <h2 class="font-headline-md text-primary mb-6">Ingin berkunjung langsung?</h2>
      <p class="text-on-surface-variant mb-8 text-body-lg">
        Silakan buat janji temu terlebih dahulu untuk kenyamanan kunjungan Anda ke area Pesantren Heritage Al‑Hikmah.
      </p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <button class="cms-btn-primary w-full md:w-auto flex items-center justify-center gap-2 bg-secondary text-white hover:bg-secondary/80 transition-colors">Jadwalkan Kunjungan</button>
        <button class="bg-white border-2 border-primary text-primary px-6 py-3 rounded-lg font-label-md hover:bg-primary/5 transition-all">Download Brosur PDF</button>
      </div>
    </div>
  </section>
</main>
@endsection

{{-- Scripts – micro‑interactions – same as original --}}
@section('script')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    form.addEventListener('submit', e => {
      e.preventDefault();
      const btn = form.querySelector('button[type="submit"]');
      const original = btn.innerHTML;
      btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Mengirim…';
      btn.disabled = true;
      setTimeout(() => {
        btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Berhasil Terkirim!';
        btn.classList.remove('bg-primary');
        btn.classList.add('bg-green-600');
        form.reset();
        setTimeout(() => {
          btn.innerHTML = original;
          btn.disabled = false;
          btn.classList.remove('bg-green-600');
          btn.classList.add('bg-primary');
        }, 3000);
      }, 1500);
    });
  });
</script>
@endsection