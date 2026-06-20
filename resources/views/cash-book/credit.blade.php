@extends('layouts.admin')

@section('title', 'Tambah Pengeluaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Tambah Pengeluaran</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Catat transaksi pengeluaran kas pesantren</p>
    </div>

    <!-- Saldo Info -->
    <div class="cms-card bg-surface-container-lowest rounded-xl p-4 mb-6 border border-outline-variant/20">
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-info text-3xl">info</span>
            <div>
                <p class="font-label-md text-on-surface">Saldo Kas Tersedia</p>
                <p class="text-2xl font-headline-sm text-info font-bold">Rp. {{ number_format($balance ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('buku-kas.credit.store') }}" method="post" class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="date" class="block font-label-sm text-on-surface mb-2">Tanggal <span class="text-error">*</span></label>
                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                    class="cms-input w-full @error('date') border-error @enderror" required>
                @error('date')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="credit" class="block font-label-sm text-on-surface mb-2">Jumlah Pengeluaran <span class="text-error">*</span></label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp.</span>
                    <input type="number" id="credit" name="credit" min="1" step="0.01"
                        value="{{ old('credit') }}"
                        class="cms-input w-full pl-12 @error('credit') border-error @enderror" required>
                </div>
                @error('credit')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-on-surface-variant text-xs mt-1">Maksimal: Rp. {{ number_format($balance ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="mb-6">
            <label for="note" class="block font-label-sm text-on-surface mb-2">Keterangan <span class="text-error">*</span></label>
            <textarea id="note" name="note" rows="4"
                class="cms-input w-full @error('note') border-error @enderror"
                required>{{ old('note') }}</textarea>
            @error('note')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-on-surface-variant text-xs mt-1">Contoh: Pembelian alat tulis, Pembayaran listrik, dll.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-secondary text-on-secondary px-6 py-2 rounded-lg font-label-md hover:bg-secondary/90 transition-colors">
                Simpan Pengeluaran
            </button>
            <a href="{{ route('buku-kas.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection