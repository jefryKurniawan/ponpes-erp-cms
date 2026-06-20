@extends('layouts.admin')

@section('title', 'Tambah Data Santri')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Tambah Data Santri</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Isi formulir di bawah untuk menambahkan santri baru.</p>
    </div>

    <form action="{{ route('santri.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Pribadi</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="name" class="block font-label-sm text-on-surface mb-2">Nama Santri</label>
                    <input type="text" class="cms-input w-full @error('name') border-error @enderror" name="name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="birth_date" class="block font-label-sm text-on-surface mb-2">Tanggal Lahir</label>
                    <input type="date" class="cms-input w-full @error('birth_date') border-error @enderror" name="birth_date" value="{{ old('birth_date') }}">
                    @error('birth_date')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="birth_place" class="block font-label-sm text-on-surface mb-2">Tempat Lahir</label>
                    <input type="text" class="cms-input w-full @error('birth_place') border-error @enderror" name="birth_place" value="{{ old('birth_place') }}">
                    @error('birth_place')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="address" class="block font-label-sm text-on-surface mb-2">Alamat</label>
                    <textarea class="cms-input w-full @error('address') border-error @enderror" name="address" rows="3">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone" class="block font-label-sm text-on-surface mb-2">No. HP</label>
                    <input type="tel" class="cms-input w-full @error('phone') border-error @enderror" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="school_old" class="block font-label-sm text-on-surface mb-2">Asal Sekolah</label>
                    <input type="text" class="cms-input w-full @error('school_old') border-error @enderror" name="school_old" value="{{ old('school_old') }}">
                    @error('school_old')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="school_address_old" class="block font-label-sm text-on-surface mb-2">Alamat Asal Sekolah</label>
                    <textarea class="cms-input w-full @error('school_address_old') border-error @enderror" name="school_address_old" rows="2">{{ old('school_address_old') }}</textarea>
                    @error('school_address_old')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Sekolah</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="school_current" class="block font-label-sm text-on-surface mb-2">Sekolah Sekarang</label>
                    <input type="text" class="cms-input w-full @error('school_current') border-error @enderror" name="school_current" value="{{ old('school_current') }}">
                    @error('school_current')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="school_address_current" class="block font-label-sm text-on-surface mb-2">Alamat Sekolah Sekarang</label>
                    <textarea class="cms-input w-full @error('school_address_current') border-error @enderror" name="school_address_current" rows="2">{{ old('school_address_current') }}</textarea>
                    @error('school_address_current')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Orang Tua</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="father_name" class="block font-label-sm text-on-surface mb-2">Nama Ayah</label>
                    <input type="text" class="cms-input w-full @error('father_name') border-error @enderror" name="father_name" value="{{ old('father_name') }}">
                    @error('father_name')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="father_job" class="block font-label-sm text-on-surface mb-2">Pekerjaan Ayah</label>
                    <input type="text" class="cms-input w-full @error('father_job') border-error @enderror" name="father_job" value="{{ old('father_job') }}">
                    @error('father_job')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="entry_year" class="block font-label-sm text-on-surface mb-2">Tahun Masuk</label>
                    <input type="text" class="cms-input w-full @error('entry_year') border-error @enderror" name="entry_year" value="{{ old('entry_year') }}">
                    @error('entry_year')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="mother_name" class="block font-label-sm text-on-surface mb-2">Nama Ibu</label>
                    <input type="text" class="cms-input w-full @error('mother_name') border-error @enderror" name="mother_name" value="{{ old('mother_name') }}">
                    @error('mother_name')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="mother_job" class="block font-label-sm text-on-surface mb-2">Pekerjaan Ibu</label>
                    <input type="text" class="cms-input w-full @error('mother_job') border-error @enderror" name="mother_job" value="{{ old('mother_job') }}">
                    @error('mother_job')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="year_out" class="block font-label-sm text-on-surface mb-2">Tahun Keluar</label>
                    <input type="text" class="cms-input w-full @error('year_out') border-error @enderror" name="year_out" value="{{ old('year_out') }}">
                    @error('year_out')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="parent_phone" class="block font-label-sm text-on-surface mb-2">No. HP Orang Tua</label>
                    <input type="tel" class="cms-input w-full @error('parent_phone') border-error @enderror" name="parent_phone" value="{{ old('parent_phone') }}">
                    @error('parent_phone')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="photo" class="block font-label-sm text-on-surface mb-2">Foto Profil</label>
                    <input type="file" class="cms-input w-full @error('photo') border-error @enderror" name="photo" accept="image/*">
                    <p class="text-on-surface-variant text-xs mt-1">Format: JPG, JPEG, PNG | Maksimal 2MB</p>
                    @error('photo')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">Tambah Santri</button>
            <a href="{{ route('santri.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">Kembali</a>
        </div>
    </form>
</div>
@endsection