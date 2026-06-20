@extends('layouts.admin')

@section('title', 'Tambah Galeri | Admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Tambah Galeri</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Tambahkan galeri baru untuk dokumentasi pesantren.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-lg border border-error bg-error-container/10 p-4">
            <h4 class="font-label-md text-error mb-2">Validasi Error:</h4>
            <ul class="list-disc list-inside text-on-surface-variant">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="nama" class="block font-label-md text-on-surface mb-2">Nama Galeri</label>
                <input type="text" class="cms-input w-full @error('nama') border-error @enderror" id="nama" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Kegiatan Ramadhan 1447 H">
                @error('nama')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="keterangan" class="block font-label-md text-on-surface mb-2">Keterangan</label>
                <textarea class="cms-input w-full @error('keterangan') border-error @enderror" id="keterangan" name="keterangan" rows="4" placeholder="Deskripsi singkat tentang galeri ini...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="is_active" class="block font-label-md text-on-surface mb-2">Status Aktif</label>
                <div class="flex items-center gap-3">
                    <input class="w-5 h-5 rounded border-outline text-primary focus:ring-primary" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    <label for="is_active" class="font-body-sm text-on-surface-variant">Centang jika galeri aktif ditampilkan</label>
                </div>
                @error('is_active')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gambar" class="block font-label-md text-on-surface mb-2">Gambar Sampul</label>
                <input class="cms-input w-full @error('gambar') border-error @enderror" type="file" id="gambar" name="gambar" accept="image/*">
                @error('gambar')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Format: JPG, PNG, maksimal 2MB</p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">Simpan Galeri</button>
                <a href="{{ route('admin.galeri.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection