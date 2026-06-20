@extends('layouts.cms')

@section('title', 'Pendaftaran Santri Baru - '.($settings ? $settings->nama_pesantren : 'Al‑Hikmah Pesantren'))
@section('description', 'Formulir pendaftaran santri baru di '.($settings ? $settings->nama_pesantren : 'Al‑Hikmah Pesantren'))
@section('og_title', 'Pendaftaran Santri Baru | '.($settings ? $settings->nama_pesantren : 'Al‑Hikmah Pesantren'))
@section('og_description', 'Daftar santri baru melalui formulir online yang mudah dan aman.')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_card', 'summary_large_image')
@section('twitter_title', 'Pendaftaran Santri Baru | '.($settings ? $settings->nama_pesantren : 'Al‑Hikmah Pesantren'))
@section('twitter_description', 'Daftar santri baru melalui formulir online yang mudah dan aman.')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))

@section('content')
<main class="pt-32 pb-24 pattern-bg min-h-screen">
  <div class="max-w-4xl mx-auto px-margin-mobile">
    <!-- Header Section -->
    <div class="text-center mb-12">
      <h1 class="font-headline-lg text-headline-lg text-primary mb-2">Penerimaan Santri Baru</h1>
      <p class="font-body-lg text-body-lg text-on-surface-variant italic">Membangun Generasi Qur'ani yang Beradab dan Cerdas Digital</p>
    </div>
    <!-- Stepper Navigation -->
    <div class="flex justify-between items-center mb-16 relative">
      <div class="absolute top-1/2 left-0 w-full h-px bg-divider-clay -z-10"></div>
      <div class="flex flex-col items-center gap-2 bg-background px-4">
        <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold" id="step-dot-1">1</div>
        <span class="font-label-md text-primary">Biodata</span>
      </div>
      <div class="flex flex-col items-center gap-2 bg-background px-4">
        <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold" id="step-dot-2">2</div>
        <span class="font-label-md text-on-surface-variant">Orang Tua</span>
      </div>
      <div class="flex flex-col items-center gap-2 bg-background px-4">
        <div class="w-10 h-10 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold" id="step-dot-3">3</div>
        <span class="font-label-md text-on-surface-variant">Dokumen</span>
      </div>
    </div>
    <!-- Registration Form -->
    <form class="space-y-12" id="psb-form" method="POST" action="{{ route('cms.psb.submit') }}">
      @csrf
      <!-- Step 1: Student Bio -->
      <section class="bg-surface-container-lowest p-8 md:p-12 rounded-xl shadow-sm border-t-4 border-primary" id="step-1">
        <div class="flex items-center gap-4 mb-8">
          <span class="material-symbols-outlined text-primary text-4xl" data-icon="person_search">person_search</span>
          <h2 class="font-headline-md text-headline-md text-secondary">Biodata Calon Santri</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
          <div class="flex flex-col gap-2">
            <label class="font-label-md text-on-surface-variant">Nama Lengkap Sesuai Ijazah</label>
            <input name="nama_lengkap" class="cms-input h-touch-target px-4 rounded-lg text-body-md" placeholder="Contoh: Ahmad Fauzi" type="text" required>
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-label-md text-on-surface-variant">NISN (Nomor Induk Siswa Nasional)</label>
            <input name="nisn" class="cms-input h-touch-target px-4 rounded-lg text-body-md" placeholder="10 digit nomor" type="number" required>
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-label-md text-on-surface-variant">Tempat Lahir</label>
            <input name="tempat_lahir" class="cms-input h-touch-target px-4 rounded-lg text-body-md" placeholder="Kota Kelahiran" type="text" required>
          </div>
          <div class="flex flex-col gap-2">
            <label class="font-label-md text-on-surface-variant">Tanggal Lahir</label>
            <input name="tanggal_lahir" class="cms-input h-touch-target px-4 rounded-lg text-body-md" type="date" required>
          </div>
          <div class="md:col-span-2 flex flex-col gap-2">
            <label class="font-label-md text-on-surface-variant">Alamat Lengkap Domisili</label>
            <textarea name="alamat" class="cms-input p-4 rounded-lg text-body-md h-32" placeholder="Jl. Raya Pesantren No. 123..." required></textarea>
          </div>
        </div>
        <div class="mt-10 flex justify-end">
          <button type="button" class="cms-btn bg-primary text-on-primary px-10 py-3 rounded-lg font-label-md flex items-center gap-2" onclick="nextStep(2)">Lanjutkan <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span></button>
        </div>
      </section>
      <!-- Step 2: Parent Info (Hidden) -->
      <section class="hidden bg-surface-container-lowest p-8 md:p-12 rounded-xl shadow-sm border-t-4 border-secondary" id="step-2">
        <div class="flex items-center gap-4 mb-8">
          <span class="material-symbols-outlined text-secondary text-4xl" data-icon="family_history">family_history</span>
          <h2 class="font-headline-md text-headline-md text-secondary">Data Orang Tua / Wali</h2>
        </div>
        <div class="space-y-10">
          <!-- Ayah -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-md border-b border-divider-clay pb-8">
            <h3 class="md:col-span-2 font-label-md text-primary flex items-center gap-2"><span class="material-symbols-outlined text-sm" data-icon="man">man</span> Data Ayah Kandung</h3>
            <div class="flex flex-col gap-2">
              <label class="font-label-sm text-on-surface-variant">Nama Ayah</label>
              <input name="nama_ayah" class="cms-input h-touch-target px-4 rounded-lg text-body-md" placeholder="Nama Lengkap" type="text" required>
            </div>
            <div class="flex flex-col gap-2">
              <label class="font-label-sm text-on-surface-variant">Pekerjaan</label>
              <select name="pekerjaan_ayah" class="cms-input h-touch-target px-4 rounded-lg text-body-md" required>
                <option>Pilih Pekerjaan</option>
                <option>PNS / TNI / POLRI</option>
                <option>Pegawai Swasta</option>
                <option>Wiraswasta</option>
                <option>Lainnya</option>
              </select>
            </div>
          </div>
          <!-- Ibu -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
            <h3 class="md:col-span-2 font-label-md text-primary flex items-center gap-2"><span class="material-symbols-outlined text-sm" data-icon="woman">woman</span> Data Ibu Kandung</h3>
            <div class="flex flex-col gap-2">
              <label class="font-label-sm text-on-surface-variant">Nama Ibu</label>
              <input name="nama_ibu" class="cms-input h-touch-target px-4 rounded-lg text-body-md" placeholder="Nama Lengkap" type="text" required>
            </div>
            <div class="flex flex-col gap-2">
              <label class="font-label-sm text-on-surface-variant">Nomor WhatsApp Aktif</label>
              <input name="wa_ibu" class="cms-input h-touch-target px-4 rounded-lg text-body-md" placeholder="0812xxxx" type="tel" required>
            </div>
          </div>
        </div>
        <div class="mt-10 flex justify-between">
          <button type="button" class="cms-btn border-2 border-outline-variant text-on-surface-variant px-8 py-3 rounded-lg font-label-md" onclick="nextStep(1)">Kembali</button>
          <button type="button" class="cms-btn bg-primary text-on-primary px-10 py-3 rounded-lg font-label-md flex items-center gap-2" onclick="nextStep(3)">Lanjutkan <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span></button>
        </div>
      </section>
      <!-- Step 3: Document Uploads (Hidden) -->
      <section class="hidden bg-surface-container-lowest p-8 md:p-12 rounded-xl shadow-sm border-t-4 border-tertiary" id="step-3">
        <div class="flex items-center gap-4 mb-8">
          <span class="material-symbols-outlined text-tertiary text-4xl" data-icon="cloud_upload">cloud_upload</span>
          <h2 class="font-headline-md text-headline-md text-secondary">Unggah Dokumen Pendukung</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
          <!-- Kartu Keluarga -->
          <div class="flex flex-col gap-4 p-6 border-2 border-dashed border-outline-variant rounded-xl hover:border-primary transition-colors group">
            <div class="flex justify-between items-start">
              <div>
                <p class="font-label-md text-on-surface">Kartu Keluarga (KK)</p>
                <p class="font-body-sm text-on-surface-variant">Format: JPG, PNG, PDF (Max 2MB)</p>
              </div>
              <span class="material-symbols-outlined text-outline-variant group-hover:text-primary" data-icon="upload_file">upload_file</span>
            </div>
            <input class="hidden" id="upload-kk" type="file" name="kk"/>
            <label class="cursor-pointer bg-surface-container py-3 rounded-lg text-center font-label-sm hover:bg-surface-variant" for="upload-kk">Pilih File</label>
          </div>
          <!-- Akta Kelahiran -->
          <div class="flex flex-col gap-4 p-6 border-2 border-dashed border-outline-variant rounded-xl hover:border-primary transition-colors group">
            <div class="flex justify-between items-start">
              <div>
                <p class="font-label-md text-on-surface">Akta Kelahiran</p>
                <p class="font-body-sm text-on-surface-variant">Format: JPG, PNG, PDF (Max 2MB)</p>
              </div>
              <span class="material-symbols-outlined text-outline-variant group-hover:text-primary" data-icon="badge">badge</span>
            </div>
            <input class="hidden" id="upload-akta" type="file" name="akta"/>
            <label class="cursor-pointer bg-surface-container py-3 rounded-lg text-center font-label-sm hover:bg-surface-variant" for="upload-akta">Pilih File</label>
          </div>
          <!-- Pas Foto -->
          <div class="flex flex-col gap-4 p-6 border-2 border-dashed border-outline-variant rounded-xl hover:border-primary transition-colors group">
            <div class="flex justify-between items-start">
              <div>
                <p class="font-label-md text-on-surface">Pas Foto 3x4</p>
                <p class="font-body-sm text-on-surface-variant">Latar belakang merah (Max 1MB)</p>
              </div>
              <span class="material-symbols-outlined text-outline-variant group-hover:text-primary" data-icon="add_a_photo">add_a_photo</span>
            </div>
            <input class="hidden" id="upload-foto" type="file" name="foto"/>
            <label class="cursor-pointer bg-surface-container py-3 rounded-lg text-center font-label-sm hover:bg-surface-variant" for="upload-foto">Pilih File</label>
          </div>
          <!-- Ijazah/SKL -->
          <div class="flex flex-col gap-4 p-6 border-2 border-dashed border-outline-variant rounded-xl hover:border-primary transition-colors group">
            <div class="flex justify-between items-start">
              <div>
                <p class="font-label-md text-on-surface">Ijazah Terakhir / SKL</p>
                <p class="font-body-sm text-on-surface-variant">Scan asli berwarna (Max 2MB)</p>
              </div>
              <span class="material-symbols-outlined text-outline-variant group-hover:text-primary" data-icon="workspace_premium">workspace_premium</span>
            </div>
            <input class="hidden" id="upload-ijazah" type="file" name="ijazah"/>
            <label class="cursor-pointer bg-surface-container py-3 rounded-lg text-center font-label-sm hover:bg-surface-variant" for="upload-ijazah">Pilih File</label>
          </div>
        </div>
        <div class="mt-12 p-6 bg-primary/5 rounded-lg border border-primary/20 flex gap-4">
          <input class="mt-1 rounded text-primary focus:ring-primary h-5 w-5" id="terms" type="checkbox" name="terms" required/>
          <label class="font-body-sm text-on-surface-variant" for="terms">Saya menyatakan bahwa data yang saya masukkan adalah benar dan dapat dipertanggungjawabkan sesuai dengan peraturan yang berlaku di Al‑Hikmah Pesantren.</label>
        </div>
        <div class="mt-10 flex justify-between">
          <button type="button" class="cms-btn border-2 border-outline-variant text-on-surface-variant px-8 py-3 rounded-lg font-label-md" onclick="nextStep(2)">Kembali</button>
          <button type="submit" class="cms-btn bg-primary text-on-primary px-12 py-3 rounded-lg font-label-md shadow-lg shadow-primary/20 flex items-center gap-2">Kirim Pendaftaran <span class="material-symbols-outlined" data-icon="send">send</span></button>
        </div>
      </section>
    </form>
  </div>
</main>
@endsection

@push('scripts')
<script>
  function nextStep(stepNumber) {
    document.getElementById('step-1').classList.add('hidden');
    document.getElementById('step-2').classList.add('hidden');
    document.getElementById('step-3').classList.add('hidden');
    document.getElementById('step-' + stepNumber).classList.remove('hidden');
    for (let i = 1; i <= 3; i++) {
      const dot = document.getElementById('step-dot-' + i);
      const label = dot.nextElementSibling;
      if (i <= stepNumber) {
        dot.classList.remove('bg-surface-container-high', 'text-on-surface-variant');
        dot.classList.add('bg-primary', 'text-on-primary');
        label.classList.remove('text-on-surface-variant');
        label.classList.add('text-primary');
      } else {
        dot.classList.remove('bg-primary', 'text-on-primary');
        dot.classList.add('bg-surface-container-high', 'text-on-surface-variant');
        label.classList.remove('text-primary');
        label.classList.add('text-on-surface-variant');
      }
    }
    window.scrollTo({ top: 200, behavior: 'smooth' });
  }

  document.getElementById('psb-form').addEventListener('submit', function(e) {
    const termsChecked = document.getElementById('terms').checked;
    if (!termsChecked) {
      e.preventDefault();
      alert('Silakan setujui pernyataan untuk melanjutkan.');
    }
  });
</script>
@endpush