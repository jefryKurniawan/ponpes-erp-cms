@extends('layouts.auth')

{{-- Meta tags --}}
@section('title', 'Login | Al‑Hikmah Pesantren')
@section('description', 'Masuk ke portal santri Al‑Hikmah Pesantren')
@section('og_title', 'Login – Al‑Hikmah Pesantren')
@section('og_description', 'Halaman login untuk santri, guru, dan staff')
@section('og_image', asset('assets/img/og-image.jpg'))
@section('twitter_title', 'Login – Al‑Hikmah Pesantren')
@section('twitter_description', 'Masuk ke portal santri Al‑Hikmah Pesantren')
@section('twitter_image', asset('assets/img/twitter-image.jpg'))
@section('og_url', request()->url())
@section('twitter_url', request()->url())

@section('content')
    {{-- Reuse the common CMS header --}}

    <main class="flex-grow flex items-center justify-center py-12 relative z-10">
        <div class="w-full max-w-md">
            {{-- Brand header inside the card area --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-surface-container-high mb-2">
                    <span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">
                        mosque
                    </span>
                </div>
                <h1 class="font-headline-md text-headline-md text-primary">Al‑Hikmah Pesantren</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Heritage Digital Ecosystem
                </p>
            </div>

            <div class="cms-card p-6 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-tertiary opacity-[0.03] rounded-full blur-2xl"></div>
                <h2 class="font-headline-sm text-headline-sm text-on-surface mb-3">Selamat Datang</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mb-5">
                    Silakan masuk ke Portal Santri untuk mengakses kurikulum, jadwal, dan administrasi akademik.
                </p>

                {{-- Validation feedback --}}
                @if ($errors->any())
                    <div class="mb-4 rounded border border-error bg-error-container/10 p-3 text-sm text-error">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    {{-- Email / Username field --}}
                    <div class="space-y-1">
                        <label for="login" class="font-label-md text-label-md text-on-surface-variant block">
                            Email atau Username
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">
                                person
                            </span>
                            <input id="login" name="login" type="text" required autofocus
                                   class="cms-input w-full pl-10"
                                   placeholder="Masukkan email atau username">
                        </div>
                    </div>

                    {{-- Password field --}}
                    <div class="space-y-1">
                        <div class="flex justify-between items-center">
                            <label for="password" class="font-label-md text-label-md text-on-surface-variant block">
                                Kata Sandi
                            </label>
                            <a href="#" class="font-label-sm text-label-sm text-secondary hover:underline">
                                Lupa Sandi?
                            </a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">
                                lock
                            </span>
                            <input id="password" name="password" type="password" required
                                   class="cms-input w-full pl-10 pr-10"
                                   placeholder="••••••••">
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors"
                                    id="togglePassword">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </div>

                    {{-- Remember me checkbox --}}
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="w-5 h-5 rounded border-outline text-primary focus:ring-primary">
                        <label for="remember" class="ml-2 font-body-sm text-body-sm text-on-surface-variant cursor-pointer">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    {{-- Submit button --}}
                    <button type="submit" class="cms-btn-primary w-full h-12 rounded-lg font-label-md text-label-md flex items-center justify-center space-x-2">
                        <span>Masuk ke Portal</span>
                        <span class="material-symbols-outlined text-[20px]">login</span>
                    </button>
                </form>

                {{-- Footer inside card --}}
                <div class="mt-6 pt-4 border-t border-divider-clay text-center">
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Belum memiliki akun?
                        <a href="#" class="text-primary font-bold hover:underline transition-all">Hubungi Admin</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection

{{-- Password‑visibility script – same logic as original page --}}
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('togglePassword');
        const pwd = document.getElementById('password');
        toggle.addEventListener('click', () => {
            const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
            pwd.setAttribute('type', type);
            toggle.querySelector('.material-symbols-outlined').textContent =
                type === 'password' ? 'visibility' : 'visibility_off';
        });
    });
</script>
@endsection