@extends('layouts.cms')

@section("title", "Formulir Pendaftaran Santri Baru | {{ $settings->nama_pesantren ?? 'Pesantren' }}")
@section('description', 'Isi formulir pendaftaran santri baru di pesantren {{ $settings->nama_pesantren ?? 'Pesantren' }}.')
@section('og_type', 'website')
@section("og_title", "Formulir Pendaftaran Santri Baru | {{ $settings->nama_pesantren ?? 'Pesantren' }}")
@section('og_description', 'Isi formulir pendaftaran santri baru di pesantren {{ $settings->nama_pesantren ?? 'Pesantren' }}.')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_card', 'summary_large_image')
@section("twitter_title", "Formulir Pendaftaran Santri Baru | {{ $settings->nama_pesantren ?? 'Pesantren' }}")
@section('twitter_description', 'Isi formulir pendaftaran santri baru di pesantren {{ $settings->nama_pesantren ?? 'Pesantren' }}.')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
<!-- Page Header -->
<section class="page-header pt-5">
    <div class="container">
        <h1 class="page-title display-5">Formulir Pendaftaran Santri Baru</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('cms.home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cms.psb') }}">Pendaftaran Santri Baru</a></li>
                <li class="breadcrumb-item active" aria-current="page">Formulir Pendaftaran</li>
            </ol>
        </nav>
    </div>
</section>

<!-- PSB Form -->
<section class="psb-form py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2 h-4 w-4"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow-sm border-0 hover-lift decorative-border">
                    <div class="card-body p-5">
                        <form action="{{ route('cms.psb.submit') }}" method="POST" id="psbForm">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control form-control-lg" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        @error('nama_lengkap')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control form-control-lg" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        @error('tempat_lahir')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        @error('tanggal_lahir')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select form-select-lg" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        @error('jenis_kelamin')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <textarea class="form-control form-control-lg" id="alamat" name="alamat" rows="3" value="{{ old('alamat') }}" required></textarea>
                                <label for="alamat">Alamat Lengkap</label>
                                @error('alamat')
                                    <div class="text-danger small>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control form-control-lg" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                                        <label for="no_telepon">Nomor Telepon</label>
                                        @error('no_telepon')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        <label for="email">Email Aktif</label>
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
                                        <label for="asal_sekolah">Asal Sekolah</label>
                                        @error('asal_sekolah')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{ old('nama_wali') }}" required>
                                        <label for="nama_wali">Nama Wali</label>
                                        @error('nama_wali')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}" required>
                                        <label for="pekerjaan_wali">Pekerjaan Wali</label>
                                        @error('pekerjaan_wali')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control" id="no_telepon_wali" name="no_telepon_wali" value="{{ old('no_telepon_wali') }}" required>
                                        <label for="no_telepon_wali">Nomor Telepon Wali</label>
                                        @error('no_telepon_wali')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="motivasi" name="motivasi" rows="4" placeholder="Tulis motivasi Anda untuk bergabung dengan pesantren kami..."></textarea>
                                <label for="motivasi">Motivasi Bergabung</label>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto mb-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2 h-4 w-4"></i> Kirim Pendaftaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Form validation and submission handling
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('psbForm');

        form.addEventListener('submit', function(e) {
            // Add any custom validation here if needed
            // For now, let the browser handle basic validation

            // Show loading state on submit
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;

            submitButton.innerHTML = '<i class="fas fa-sync me-2 h-4 w-4"></i> Mengirim...';
            submitButton.disabled = true;

            // In a real application, you might want to use AJAX here
            // For this example, we'll let it submit normally
        });
    });
</script>
@endpush