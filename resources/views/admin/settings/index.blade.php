@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
@php $flash = session('success') ?? session('error'); @endphp
@if ($flash)
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 bg-{{ session('error') ? 'red' : 'green' }}-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="{{ session('error') ? 'M6 18L18 6M6 6l12 12' : 'M5 13l4 4L19 7' }}"/>
        </svg>
        <span>{{ $flash }}</span>
    </div>
@endif
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
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
<button class="px-lg py-md font-label-md tab-active whitespace-nowrap transition-all duration-200 border-b-2 border-primary" id="tab-btn-branding" onclick="switchTab('branding')">Branding</button>
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
<button id="btn-upload-favicon" type="button" class="text-primary font-label-sm hover:underline">Unggah Baru</button>

<!-- Upload Modal -->
<div id="modal-upload-favicon" class="hidden fixed inset-0 z-[100] items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-surface rounded-xl p-lg max-w-md w-full mx-4 shadow-2xl">
        <h4 class="font-headline-sm text-on-surface mb-sm">Unggah Favicon</h4>
        <p class="font-body-sm text-on-surface-variant mb-md">Pilih file favicon (.ico, .png) dengan ukuran 16x16 atau 32x32 piksel.</p>

        <form action="{{ route('admin.settings.uploadFavicon') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-md">
                <label class="block w-full h-32 border-2 border-dashed border-outline-variant rounded-lg flex flex-col items-center justify-center cursor-pointer hover:bg-surface-container-high transition-colors">
                    <input type="file" name="favicon" accept=".ico,.png" class="hidden" id="favicon-input" required/>
                    <span class="material-symbols-outlined text-outline mb-xs">upload_file</span>
                    <span class="font-label-sm text-on-surface-variant" id="favicon-filename">Klik untuk pilih file</span>
                </label>
            </div>
            <div class="flex justify-end gap-sm">
                <button type="button" id="btn-batal" class="px-md py-xs rounded-lg font-label-sm bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors">Batal</button>
                <button type="submit" class="px-md py-xs rounded-lg font-label-sm bg-primary text-on-primary hover:opacity-90 transition-opacity">Unggah</button>
            </div>
        </form>
    </div>
</div>
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
<!-- Floating Action Button -->
<div class="fixed bottom-lg right-lg z-[60]">
<button class="bg-primary text-on-primary shadow-lg shadow-primary/30 px-lg py-md rounded-full flex items-center gap-sm hover:scale-105 active:scale-95 transition-all group">
<span class="material-symbols-outlined group-hover:rotate-12 transition-transform">save</span>
<span class="font-label-md">Simpan Perubahan</span>
</button>
</div>
<!-- Footer -->
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
                btn.classList.remove('tab-active','tab-inactive','border-b-2','border-primary');
                btn.classList.add('tab-inactive');
            });

            const activeBtn = document.getElementById('tab-btn-' + tabId);
            activeBtn.classList.remove('tab-inactive');
            activeBtn.classList.add('tab-active','border-b-2','border-primary');
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

        // Modal upload favicon dengan jQuery
        $(document).ready(function() {
            $('#btn-upload-favicon').on('click', function() {
                $('#modal-upload-favicon').removeClass('hidden').addClass('flex');
            });

            $('#btn-batal').on('click', function() {
                $('#modal-upload-favicon').removeClass('flex').addClass('hidden');
            });

            $('#modal-upload-favicon').on('click', function(e) {
                if ($(e.target).is('#modal-upload-favicon')) {
                    $(this).removeClass('flex').addClass('hidden');
                }
            });

            $('#favicon-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $('#favicon-filename').text(fileName || 'Klik untuk pilih file');
            });
        });
    </script>
@endsection