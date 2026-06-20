@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Tambah Berita</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Tambahkan berita baru untuk pesantren.</p>
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
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="judul" class="block font-label-md text-on-surface mb-2">Judul</label>
                <input type="text" class="cms-input w-full @error('judul') border-error @enderror" id="judul" name="judul" value="{{ old('judul') }}" required placeholder="Contoh: Pesantren Al-Hikmah Gelar Kajian Ramadan 1447 H">
                @error('judul')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block font-label-md text-on-surface mb-2">Slug (opsional)</label>
                <input type="text" class="cms-input w-full @error('slug') border-error @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Biarkan kosong untuk digenerate otomatis">
                @error('slug')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Biarkan kosong untuk digenerate otomatis dari judul</p>
            </div>

            <div>
                <label for="category_id" class="block font-label-md text-on-surface mb-2">Kategori</label>
                <select class="cms-input w-full @error('category_id') border-error @enderror" id="category_id" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block font-label-md text-on-surface mb-2">Status</label>
                <select class="cms-input w-full @error('status') border-error @enderror" id="status" name="status" required>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="published_at" class="block font-label-md text-on-surface mb-2">Tanggal Publikasi</label>
                <input type="datetime-local" class="cms-input w-full @error('published_at') border-error @enderror" id="published_at" name="published_at" value="{{ old('published_at') }}">
                @error('published_at')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="isi" class="block font-label-md text-on-surface mb-2">Isi Berita</label>
                <textarea class="cms-input w-full @error('isi') border-error @enderror" id="isi" name="isi" rows="10" placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>
                @error('isi')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="block font-label-md text-on-surface mb-2">Thumbnail (Gambar)</label>
                <input class="cms-input w-full @error('thumbnail') border-error @enderror" type="file" id="thumbnail" name="thumbnail" accept="image/*">
                @error('thumbnail')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Format: JPG, PNG, maksimal 2MB</p>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">Simpan Berita</button>
                <a href="{{ route('admin.berita.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection