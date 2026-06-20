@extends('layouts.admin')

@section('title', 'Edit Biaya Pembayaran Pesantren')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Edit Biaya Pembayaran Pesantren</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Perbarui informasi biaya dan pembayaran pesantren.</p>
    </div>

    <form action="{{ route('biaya.update') }}" method="post" class="space-y-6">
        @csrf
        @method('PATCH')

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Biaya Rutin</h3>
            <div>
                <label for="spp" class="block font-label-md text-on-surface mb-2">Biaya Syahriah/SPP (per bulan)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp.</span>
                    <input id="spp" type="number" class="cms-input w-full pl-12 @error('spp') border-error @enderror" name="spp" value="{{ old('spp', $data?->spp ?? 0) }}" required autocomplete="spp" min="0" step="0.01">
                </div>
                @error('spp')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Biaya bulanan yang dikenakan untuk setiap santri aktif</p>
            </div>
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Biaya Pendaftaran Baru</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="construction" class="block font-label-md text-on-surface mb-2">Biaya Pembangunan</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp.</span>
                        <input id="construction" type="number" class="cms-input w-full pl-12 @error('construction') border-error @enderror" name="construction" value="{{ old('construction', $data?->construction ?? 0) }}" required autocomplete="construction" min="0" step="0.01">
                    </div>
                    @error('construction')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-on-surface-variant text-sm mt-1">Biaya pengembangan infrastruktur</p>
                </div>
                <div>
                    <label for="facilities" class="block font-label-md text-on-surface mb-2">Biaya Fasilitas</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp.</span>
                        <input id="facilities" type="number" class="cms-input w-full pl-12 @error('facilities') border-error @enderror" name="facilities" value="{{ old('facilities', $data?->facilities ?? 0) }}" required autocomplete="facilities" min="0" step="0.01">
                    </div>
                    @error('facilities')
                        <p class="text-error text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-on-surface-variant text-sm mt-1">Penggunaan fasilitas umum pesantren</p>
                </div>
            </div>
        </div>

        <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
            <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Biaya Lainnya</h3>
            <div>
                <label for="wardrobe" class="block font-label-md text-on-surface mb-2">Biaya Alokasi Almari</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp.</span>
                    <input id="wardrobe" type="number" class="cms-input w-full pl-12 @error('wardrobe') border-error @enderror" name="wardrobe" value="{{ old('wardrobe', $data?->wardrobe ?? 0) }}" required autocomplete="wardrobe" min="0" step="0.01">
                </div>
                @error('wardrobe')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-sm mt-1">Penyediaan almari untuk kebutuhan santri</p>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">Update Biaya</button>
            <a href="{{ route('biaya.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">Kembali</a>
        </div>
    </form>
</div>
@endsection