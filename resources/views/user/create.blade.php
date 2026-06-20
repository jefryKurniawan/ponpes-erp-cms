@extends('layouts.admin')

@section('title', 'Tambah Data Pengguna')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Tambah Data Pengguna</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Isi formulir di bawah untuk menambahkan pengguna baru.</p>
    </div>

    <form action="{{ route('pengguna.store') }}" method="post" class="space-y-6">
        @csrf

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Akun</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="santri_id" class="block font-label-sm text-on-surface mb-2">Nama Santri</label>
                    <select class="cms-input w-full @error('santri_id') border-error @enderror" name="santri_id" required>
                        <option value="" disabled selected>Pilih Santri</option>
                        @foreach($data as $santri)
                            <option value="{{ $santri->id }}"
                                @if(\App\Models\User::where('santri_id', $santri->id)->exists())
                                    disabled
                                @endif>{{ $santri->name }}</option>
                        @endforeach
                    </select>
                    @error('santri_id')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-on-surface-variant text-xs mt-1">Santri yang sudah memiliki akun tidak akan muncul.</p>
                </div>
                <div>
                    <label for="email" class="block font-label-sm text-on-surface mb-2">E-Mail Address</label>
                    <input id="email" type="email" class="cms-input w-full @error('email') border-error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="role_id" class="block font-label-sm text-on-surface mb-2">Role</label>
                    <select class="cms-input w-full @error('role_id') border-error @enderror" name="role_id" required>
                        <option value="" disabled selected>Pilih Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block font-label-sm text-on-surface mb-2">Password</label>
                    <div class="relative">
                        <input id="password" type="password" class="cms-input w-full @error('password') border-error @enderror" name="password" required autocomplete="new-password">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary" onclick="togglePassword('password')">
                            <span class="material-symbols-outlined text-sm" id="password-icon">visibility_off</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password_confirmation" class="block font-label-sm text-on-surface mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" class="cms-input w-full" name="password_confirmation" required autocomplete="new-password">
                        <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary" onclick="togglePassword('password_confirmation')">
                            <span class="material-symbols-outlined text-sm" id="password_confirmation-icon">visibility_off</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">Tambah Pengguna</button>
            <a href="{{ route('pengguna.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">Kembali</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + '-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility_off';
        }
    }
</script>
@endpush
@endsection