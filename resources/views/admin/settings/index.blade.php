@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
<!-- Top Navigation Bar -->
<header class="fixed top-0 w-full z-50 bg-surface/95 backdrop-blur-md border-b border-secondary/10 shadow-sm h-20 px-gutter">
<div class="max-w-7xl mx-auto flex justify-between items-center h-full">
<h1 class="font-headline-md text-headline-md text-primary">Al-Hikmah Pesantren</h1>
<nav class="hidden md:flex gap-md items-center">
<a class="font-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Tentang Kami</a>
<a class="font-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Program</a>
<a class="font-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Pendaftaran</a>
<a class="font-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Galeri</a>
<a class="font-body-md text-on-surface-variant hover:text-primary transition-colors" href="#">Kontak</a>
<button class="bg-primary text-on-primary px-lg py-base rounded-lg font-label-md hover:scale-95 transition-transform">Portal Santri</button>
</nav>
</div>
</header>
<div class="pt-20 flex min-h-screen">
<!-- Sidebar Shell (Mocked as per shared logic) -->
<aside class="hidden lg:flex flex-col w-64 bg-surface-container-low border-r border-divider-clay p-md gap-sm sticky top-20 h-[calc(100vh-80px)]">
<div class="flex items-center gap-xs mb-lg">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">settings_applications</span>
<span class="font-headline-sm text-primary">Admin Panel</span>
</div>
<nav class="space-y-xs">
<a class="flex items-center gap-sm p-sm rounded-lg hover:bg-primary/5 text-on-surface-variant transition-all" href="{{ route('home') }}">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md">Dashboard</span>
</a>
<a class="flex items-center gap-sm p-sm rounded-lg hover:bg-primary/5 text-on-surface-variant transition-all" href="{{ route('santri.index') }}">
<span class="material-symbols-outlined">school</span>
<span class="font-label-md">Data Santri</span>
</a>
<a class="flex items-center gap-sm p-sm rounded-lg bg-primary-container text-on-primary-container font-bold shadow-sm" href="{{ route('admin.settings.index') }}">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">settings</span>
<span class="font-label-md">Pengaturan</span>
</a>
<a class="flex items-center gap-sm p-sm rounded-lg hover:bg-primary/5 text-on-surface-variant transition-all" href="{{ route('biaya.index') }}">
<span class="material-symbols-outlined">payments</span>
<span class="font-label-md">Administrasi</span>
</a>
<a class="flex items-center gap-sm p-sm rounded-lg hover:bg-primary/5 text-on-surface-variant transition-all" href="{{ route('pengguna.index') }}">
<span class="material-symbols-outlined">logout</span>
<span class="font-label-md">Keluar</span>
</a>
</nav>
</aside>
<!-- Main Content Area -->
<main class="flex-1 p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
<!-- Subtle Batik Texture Background -->
<div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
<div class="max-w-5xl mx-auto space-y-lg relative z-10">
<header>
<h2 class="font-headline-md text-headline-md text-on-surface mb-xs">Pengaturan Sistem</h2>
<p class="font-body-md text-on-surface-variant">Konfigurasi branding, tema, dan informasi pendaftaran pesantren Anda.</p>
</header>
<!-- Tabbed Interface -->
<div class="cms-card overflow-hidden">
<div class="flex border-b border-divider-clay bg-surface-container-lowest overflow-x-auto no-scrollbar">
<button class="px-lg py-md font-label-md tab-active whitespace-nowrap transition-all duration-200" id="tab-btn-branding" onclick="switchTab('branding')">Branding</button>
<button class="px-lg py-md font-label-md tab-inactive whitespace-nowrap transition-all duration-200" id="tab-btn-theme" onclick="switchTab('theme')">Tema Visual</button>
<button class="px-lg py-md font-label-md tab-inactive whitespace-nowrap transition-all duration-200" id="tab-btn-landing" onclick="switchTab('landing')">Halaman Depan</button>
<button class="px-lg py-md font-label-md tab-inactive whitespace-nowrap transition-all duration-200" id="tab-btn-contact" onclick="switchTab('contact')">Kontak & Sosial</button>
<button class="px-lg py-md font-label-md tab-inactive whitespace-nowrap transition-all duration-200" id="tab-btn-system" onclick="switchTab('system')">Sistem</button>
</div>
<div class="p-lg">
<!-- Branding Tab Content -->
<div class="space-y-lg animate-in fade-in duration-500" id="tab-content-branding">
<div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
<div class="space-y-md">
<label class="block">
<span class="font-label-md text-on-surface-variant">Nama Pesantren</span>
<input class="mt-base block w-full rounded-lg border-outline focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md p-sm bg-surface" type="text" value="Al-Hikmah Digital Pesantren"/>
</label>
<label class="block">
<span class="font-label-md text-on-surface-variant">Tagline</span>
<input class="mt-base block w-full rounded-lg border-outline focus:ring-2 focus:ring-primary/20 focus:border-primary font-body-md p-sm bg-surface" type="text" value="Mencetak Generasi Qur'ani yang Berwawasan Teknologi"/>
</label>
</div>
<div class="flex flex-col gap-md">
<div>
<span class="font-label-md text-on-surface-variant">Logo Utama</span>
<div class="mt-base flex items-center gap-md">
<div class="w-24 h-24 bg-surface-container-high rounded-lg flex items-center justify-center border-2 border-dashed border-outline-variant overflow-hidden">
<img class="w-16 h-16 object-contain" data-alt="A professional and elegant Islamic pesantren logo featuring a stylized open book or Quran and a minimalist mosque dome silhouette. The color palette uses rich forest green and warm terracotta accents, designed in a modern vector style with clean lines on a transparent background." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBheQ8qpopSD7fR0PlQO7zZKVgfBl0e7i9gfdk5mBnVVcFvEcCQzLAWDq69nwVaudimJWZ6cidR4w19NSZArbgTczzveHbHOPXHcNUoZ9OYR3rMZpP_ifwQIKtCYsjkR7qB00Py1CTTHK2iSQGcl_ZEfyvD1Zg-uKVebQ6h3NsdrIafm5BhjXPZdLv2hUlpmyVlcFrRlYXGBvrIjlf7OOLqsGS2rdfMBr1O1hvas6oSxOfeC1Ykicr3E7i6a2AmVOsGpYqRs4vPmqvx"/>
</div>
<button class="bg-surface-container-lowest border border-outline px-md py-xs rounded-lg font-label-sm hover:bg-surface-variant transition-colors">Ganti Logo</button>
</div>
</div>
<div>
<span class="font-label-md text-on-surface-variant">Favicon (16x16 / 32x32)</span>
<div class="mt-base flex items-center gap-md">
<div class="w-10 h-10 bg-surface-container-high rounded flex items-center justify-center border border-outline-variant">
<span class="material-symbols-outlined text-primary-fixed-dim">image</span>
</div>
<button class="text-primary font-label-sm hover:underline">Unggah Baru</button>
</div>
</div>
</div>
</div>
</div>
<!-- Theme Tab Content (Teaser) -->
<div class="hidden space-y-lg" id="tab-content-theme">
<div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
<div class="space-y-md">
<h4 class="font-label-md text-secondary border-b border-divider-clay pb-xs">Skema Warna</h4>
<div class="flex items-center gap-sm">
<input class="w-10 h-10 border-none rounded cursor-pointer" type="color" value="#006948"/>
<span class="font-body-sm">Warna Utama (Teal)</span>
</div>
<div class="flex items-center gap-sm">
<input class="w-10 h-10 border-none rounded cursor-pointer" type="color" value="#934b19"/>
<span class="font-body-sm">Warna Sekunder (Terracotta)</span>
</div>
<div class="flex items-center gap-sm">
<input class="w-10 h-10 border-none rounded cursor-pointer" type="color" value="#735c00"/>
<span class="font-body-sm">Warna Aksen (Gold)</span>
</div>
</div>
<div class="space-y-md md:col-span-2">
<h4 class="font-label-md text-secondary border-b border-divider-clay pb-xs">Tipografi (Google Fonts)</h4>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
<label>
<span class="font-label-sm text-on-surface-variant">Font Judul</span>
<select class="mt-base block w-full rounded-lg border-outline bg-surface font-body-md p-sm">
<option selected="">Kalam</option>
<option>Playfair Display</option>
<option>Cinzel</option>
</select>
</label>
<label>
<span class="font-label-sm text-on-surface-variant">Font Konten</span>
<select class="mt-base block w-full rounded-lg border-outline bg-surface font-body-md p-sm">
<option selected="">Lora</option>
<option>Roboto</option>
<option>Merriweather</option>
</select>
</label>
</div>
</div>
</div>
</div>
<!-- Landing Page Tab Content (Teaser) -->
<div class="hidden space-y-lg" id="tab-content-landing">
<div class="bg-surface-container-low p-md rounded-lg border-l-4 border-primary">
<h4 class="font-headline-sm text-primary mb-xs">Pengaturan Banner Utama</h4>
<div class="grid grid-cols-2 md:grid-cols-4 gap-sm mb-md">
<div class="aspect-video bg-surface-variant rounded-lg relative overflow-hidden group">
<img class="w-full h-full object-cover" data-alt="A serene wide-angle shot of a modern Indonesian Islamic boarding school campus during the golden hour. Lush tropical gardens surround a central building with elegant geometric arched windows. The lighting is warm and ethereal, creating a peaceful academic atmosphere. High-end architectural photography style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbzpOi9YPytdU3B6UVuYHWkqBwKGwehoU9pzGjYGEVOQlZKkI2EwnwXTHQWD30Y7-gLTAqs4Ev3D9s1d_iFPhy_IrpWzYUbHhgcfd2EhD8p02snnWIoCNP_5qMhIsmclg64cpVEPQJi-v0ZIYnOivI5MQiOF3l_2TyZNewQDPOWhsSgzCpXR8EgKm6-0seBmYmIDXiwzWHKaJ_PMn4sIuzM_fgAAakvtNFJMvozu_y_-Xr7MyEgks6DLJdlAFzWY2wtwtWa97RZtdw"/>
<div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity cursor-pointer">
<span class="material-symbols-outlined text-white">delete</span>
</div>
</div>
<div class="aspect-video bg-surface-variant rounded-lg border-2 border-dashed border-outline-variant flex flex-col items-center justify-center text_on-surface-variant cursor-pointer hover:bg-surface-container-high transition-all">
<span class="material-symbols-outlined">add_photo_alternate</span>
<span class="font-label-sm mt-xs">Tambah Foto</span>
</div>
</div>
<div class="space-y-md">
<label class="block">
<span class="font-label-md text-on-surface-variant">Visi & Misi (Rich Text)</span>
<textarea class="mt-base block w-full rounded-lg border-outline bg-surface font-body-md p-sm" placeholder="Masukkan visi dan misi lembaga..." rows="4"></textarea>
</label>
<div class="bg-surface-container-highest p-md rounded-lg">
<h5 class="font-label-md text-secondary mb-sm">Pendaftaran Santri Baru (PSB)</h5>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
<label>
<span class="font-label-sm">Tanggal Buka</span>
<input class="mt-xs block w-full rounded-lg border-outline bg-surface font-body-sm p-xs" type="date"/>
</label>
<label>
<span class="font-label-sm">Tanggal Tutup</span>
<input class="mt-xs block w-full rounded-lg border-outline bg-surface font-body-sm p-xs" type="date"/>
</label>
</div>
</div>
</div>
</div>
</div>
<!-- Contact Tab Content -->
<div class="hidden space-y-lg" id="tab-content-contact">
<div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
<div class="space-y-md">
<h4 class="font-label-md text-secondary">Media Sosial</h4>
<div class="space-y-sm">
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded bg-secondary-container flex items-center justify-center text_on-secondary-container">
<span class="material-symbols-outlined">chat</span>
</div>
<input class="flex-1 rounded-lg border-outline bg-surface font-body-md p-sm" placeholder="Nomor WhatsApp" type="text"/>
</div>
<div class="flex items-center gap-sm">
<div class="w-10 h-10 rounded bg-secondary-container flex items-center justify-center text_on-secondary-container">
<span class="material-symbols-outlined">camera</span>
</div>
<input class="flex-1 rounded-lg border-outline bg-surface font-body-md p-sm" placeholder="URL Instagram" type="text"/>
</div>
</div>
</div>
<div class="space-y-md">
<h4 class="font-label-md text-secondary">Lokasi Geografis</h4>
<label class="block">
<span class="font-label-sm">Google Maps Embed URL</span>
<input class="mt-base block w-full rounded-lg border-outline bg-surface font-body-md p-sm" placeholder="https://maps.google.com/..." type="text"/>
</label>
<div class="h-32 w-full bg-surface-variant rounded-lg flex items-center justify-center border border-outline-variant border-dashed">
<span class="font-label-sm text-outline italic">Preview Map akan tampil di sini</span>
</div>
</div>
</div>
</div>
<!-- System Tab Content (Teaser) -->
<div class="hidden" id="tab-content-system">
<div class="p-lg border-2 border-dashed border-outline-variant rounded-xl text-center space-y-md">
<span class="material-symbols-outlined text-surface-dim scale-[2]" style="font-size: 48px;">dns</span>
<p class="font-body-md text_on-surface-variant max-w-sm mx-auto">Konfigurasi database, backup otomatis, dan manajemen API key hanya tersedia untuk Administrator Utama.</p>
<button class="bg-surface-variant text_on-surface-variant px-md py-xs rounded-lg font-label-md">Minta Akses</button>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
<!-- Floating Action Button -->
<div class="fixed bottom-lg right-lg z-[60]">
<button class="bg-primary text-on-primary shadow-lg shadow-primary/30 px-lg py-md rounded-full flex items-center gap-sm hover:scale-105 active:scale-95 transition-all group">
<span class="material-symbols-outlined group-hover:rotate-12 transition-transform">save</span>
<span class="font-label-md">Simpan Perubahan</span>
</button>
</div>
<!-- Footer -->
<footer class="bg-surface-container-low border-t border-divider-clay py-12 px-gutter mt-auto relative z-10">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-lg">
<div class="col-span-1 md:col-span-2">
<span class="font-headline-md text-headline-md text-primary mb-4 block">Al-Hikmah Pesantren</span>
<p class="font-body-sm text_on-surface-variant max-w-sm">© 2024 Al-Hikmah Digital Pesantren. Terakreditasi Nasional. Berdedikasi mencetak insan kamil di era digital.</p>
</div>
<div>
<h5 class="font-label-md text-secondary mb-md">Pendidikan</h5>
<ul class="space-y-xs font-body-sm text_on-surface-variant">
<li><a class="hover:text-secondary underline transition-all" href="#">Kurikulum Kitab Kuning</a></li>
<li><a class="hover:text-secondary underline transition-all" href="#">Tahfidz Al-Qur'an</a></li>
<li><a class="hover:text-secondary underline transition-all" href="#">Ekstrakurikuler</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md text-secondary mb-md">Layanan</h5>
<ul class="space-y-xs font-body-sm text_on-surface-variant">
<li><a class="hover:text-secondary underline transition-all" href="#">Biaya Pendidikan</a></li>
<li><a class="hover:text-secondary underline transition-all" href="#">Kebijakan Privasi</a></li>
</ul>
</div>
</div>
</footer>
<script>
        function switchTab(tabId) {
            // Hide all contents
            const contents = document.querySelectorAll('[id^="tab-content-"]');
            contents.forEach(c => c.classList.add('hidden'));

            // Show selected content
            document.getElementById('tab-content-' + tabId).classList.remove('hidden');

            // Update button styles
            const buttons = document.querySelectorAll('[id^="tab-btn-"]');
            buttons.forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('tab-inactive');
            });

            const activeBtn = document.getElementById('tab-btn-' + tabId);
            activeBtn.classList.remove('tab-inactive');
            activeBtn.classList.add('tab-active');
        }

        // Add some subtle hover interaction to buttons
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                if(!btn.classList.contains('tab-active')) btn.style.transform = 'translateY(-1px)';
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection