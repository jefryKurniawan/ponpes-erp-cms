@extends('layouts.admin')

@section('title', 'Tambah Pemasukan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Tambah Pemasukan</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Catat transaksi pemasukan kas pesantren</p>
    </div>

    <form action="{{ route('buku-kas.debit.store') }}" method="post" class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20">
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
                <label for="debit" class="block font-label-sm text-on-surface mb-2">Jumlah Pemasukan <span class="text-error">*</span></label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md">Rp.</span>
                    <input type="number" id="debit" name="debit" min="1" step="0.01"
                        value="{{ old('debit') }}"
                        class="cms-input w-full pl-12 @error('debit') border-error @enderror" required>
                </div>
                @error('debit')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
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
            <p class="text-on-surface-variant text-xs mt-1">Contoh: Sumbangan dari wali santri, Hasil usaha pesantren, dll.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:bg-primary/90 transition-colors">
                Simpan Pemasukan
            </button>
            <a href="{{ route('buku-kas.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container transition-colors">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection