@extends('layouts.admin')

@section('title', 'Biaya Pembayaran Pesantren')

@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-on-surface">Biaya Pembayaran Pesantren</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Informasi biaya dan pembayaran pesantren</p>
                    </div>
                    @if(auth()->user()->role->name == 'Administrator')
                    <a href="{{ route('biaya.edit') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined text-sm align-text-bottom mr-1">edit</span>
                        Edit Biaya
                    </a>
                    @endif
                </div>
            </div>

            @if(Session::has('alert'))
                <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
                    <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
                </div>
            @endif

            @if(empty($data))
                <div class="cms-card bg-surface-container-lowest rounded-xl p-8 border border-outline-variant/20 text-center">
                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/50 mb-4">payments</span>
                    <p class="text-on-surface-variant mb-2">Belum ada data biaya yang dikonfigurasi.</p>
                    @if(auth()->user()->role->name == 'Administrator')
                    <a href="{{ route('biaya.edit') }}" class="inline-flex items-center bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors mt-4">
                        <span class="material-symbols-outlined text-sm mr-1">add</span>
                        Tambah Data Biaya
                    </a>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Biaya Syahriah/SPP -->
                    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="bg-primary/10 px-6 py-4 border-b border-outline-variant/10">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary text-2xl">receipt_long</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Biaya Syahriah/SPP</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-3xl font-headline-md text-primary font-bold">Rp. {{ number_format($data->spp ?? 0, 0, ',', '.') }}</p>
                                <p class="text-on-surface-variant text-sm mt-2">/bulan</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-outline-variant/10">
                                <p class="text-xs text-on-surface-variant text-center">Pembayaran rutin bulanan untuk setiap santri</p>
                            </div>
                        </div>
                    </div>

                    <!-- Biaya Pembangunan -->
                    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="bg-secondary/10 px-6 py-4 border-b border-outline-variant/10">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-secondary text-2xl">construction</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Biaya Pembangunan</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-3xl font-headline-md text-secondary font-bold">Rp. {{ number_format($data->construction ?? 0, 0, ',', '.') }}</p>
                                <p class="text-on-surface-variant text-sm mt-2">/pendaftar baru</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-outline-variant/10">
                                <p class="text-xs text-on-surface-variant text-center">Biaya pengembangan infrastruktur pesantren</p>
                            </div>
                        </div>
                    </div>

                    <!-- Biaya Fasilitas -->
                    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="bg-accent/10 px-6 py-4 border-b border-outline-variant/10">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-600 text-2xl">hot_tub</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Biaya Fasilitas</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-3xl font-headline-md text-amber-600 font-bold">Rp. {{ number_format($data->facilities ?? 0, 0, ',', '.') }}</p>
                                <p class="text-on-surface-variant text-sm mt-2">/pendaftar baru</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-outline-variant/10">
                                <p class="text-xs text-on-surface-variant text-center">Penggunaan fasilitas umum pesantren</p>
                            </div>
                        </div>
                    </div>

                    <!-- Biaya Alokasi Almari -->
                    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="bg-info/10 px-6 py-4 border-b border-outline-variant/10">
                            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-info text-2xl">storage</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Biaya Alokasi Almari</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="text-center">
                                <p class="text-3xl font-headline-md text-info font-bold">Rp. {{ number_format($data->wardrobe ?? 0, 0, ',', '.') }}</p>
                                <p class="text-on-surface-variant text-sm mt-2">/pendaftar baru</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-outline-variant/10">
                                <p class="text-xs text-on-surface-variant text-center">Penyediaan almari untuk kebutuhan santri</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Tambahan -->
                <div class="mt-8 cms-card bg-info-container/10 border border-info/20 rounded-xl p-6">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-info text-3xl">info</span>
                        <div>
                            <h4 class="font-label-md text-info mb-2">Informasi Pembayaran</h4>
                            <p class="text-on-surface-variant text-sm">
                                Semua biaya di atas dikenakan untuk setiap santri aktif Pesantren Al-Hikmah.
                                Pembayaran dapat dilakukan melalui transfer bank atau tunai di bagian administrasi.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection