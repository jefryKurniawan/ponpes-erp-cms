@extends('layouts.admin')

@section('title', 'Manajemen Keuangan')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Manajemen Keuangan</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola transaksi pemasukan dan pengeluaran pesantren</p>
            </div>
            @canany('admin','bendahara')
            <a href="{{ route('keuangan.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Transaksi
            </a>
            @endcanany
        </div>
    </div>

    @if(Session::has('success'))
        <div class="mb-6 rounded-lg border border-success bg-success-container/10 p-4">
            <p class="font-body-sm text-success">{{ Session('success') }}</p>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Pemasukan -->
        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-success/10 px-6 py-4 border-b border-outline-variant/10">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-success text-2xl">trending_up</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Pemasukan</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-headline-md text-success font-bold">Rp. {{ number_format($pemasukan, 0, ',', '.') }}</p>
                <p class="text-on-surface-variant text-sm mt-2">Total pemasukan bulan ini</p>
            </div>
        </div>

        <!-- Total Pengeluaran -->
        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-error/10 px-6 py-4 border-b border-outline-variant/10">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-error text-2xl">trending_down</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Pengeluaran</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-headline-md text-error font-bold">Rp. {{ number_format($pengeluaran, 0, ',', '.') }}</p>
                <p class="text-on-surface-variant text-sm mt-2">Total pengeluaran bulan ini</p>
            </div>
        </div>

        <!-- Saldo Kas -->
        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-info/10 px-6 py-4 border-b border-outline-variant/10">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-info text-2xl">account_balance_wallet</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Saldo Kas</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-headline-md {{ $saldo >= 0 ? 'text-success' : 'text-error' }} font-bold">Rp. {{ number_format($saldo, 0, ',', '.') }}</p>
                <p class="text-on-surface-variant text-sm mt-2">Saldo saat ini</p>
            </div>
        </div>

        <!-- Jumlah Transaksi -->
        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="bg-primary/10 px-6 py-4 border-b border-outline-variant/10">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-2xl">receipt_long</span>
                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Transaksi</h3>
                </div>
            </div>
            <div class="p-6">
                <p class="text-3xl font-headline-md text-primary font-bold">{{ $data->total() }}</p>
                <p class="text-on-surface-variant text-sm mt-2">Total transaksi tercatat</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="cms-card bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/20 mb-6">
        <h3 class="font-headline-sm text-headline-sm text-on-surface mb-4">Filter Transaksi</h3>
        <form method="GET" action="{{ route('keuangan.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="date" class="block font-label-sm text-on-surface mb-2">Tanggal</label>
                <input type="date" id="date" name="date" value="{{ $filter['date'] ?? '' }}"
                    class="cms-input w-full">
            </div>
            <div>
                <label for="tipe" class="block font-label-sm text-on-surface mb-2">Jenis</label>
                <select id="tipe" name="tipe" class="cms-input w-full @error('tipe') border-error @enderror">
                    <option value="">Semua Jenis</option>
                    <option value="pemasukan" {{ ($filter['tipe'] ?? '') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ ($filter['tipe'] ?? '') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label for="category_id" class="block font-label-sm text-on-surface mb-2">Kategori</label>
                <select id="category_id" name="category_id" class="cms-input w-full">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($filter['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }} ({{ $category->tipe }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors flex-1">
                    Filter
                </button>
                <a href="{{ route('keuangan.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors whitespace-nowrap">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Export Buttons -->
    @canany('admin','bendahara')
    <div class="flex gap-3 mb-6">
        <a href="{{ route('keuangan.export', ['type' => 'pdf']) }}" class="border border-error/30 bg-error-container/10 text-error px-4 py-2 rounded-lg font-label-sm hover:bg-error/20 transition-colors inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
            Export PDF
        </a>
        <a href="{{ route('keuangan.export', ['type' => 'excel']) }}" class="border border-success/30 bg-success-container/10 text-success px-4 py-2 rounded-lg font-label-sm hover:bg-success/20 transition-colors inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">table_view</span>
            Export Excel
        </a>
    </div>
    @endcanany

    <!-- Transactions Table -->
    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container text-on-surface-variant text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left font-label-sm">Tanggal</th>
                        <th class="px-6 py-4 text-left font-label-sm">Kategori</th>
                        <th class="px-6 py-4 text-left font-label-sm">Keterangan</th>
                        <th class="px-6 py-4 text-center font-label-sm">Jenis</th>
                        <th class="px-6 py-4 text-right font-label-sm">Jumlah</th>
                        <th class="px-6 py-4 text-center font-label-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @if($data->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">receipt_long</span>
                                <p class="text-on-surface-variant">Belum ada transaksi keuangan.</p>
                            </td>
                        </tr>
                    @else
                        @foreach($data as $transaction)
                            <tr class="hover:bg-surface-container/50 transition-colors">
                                <td class="px-6 py-4 text-on-surface font-body-sm">{{ $transaction->date }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-label-sm"
                                        style="background-color: {{ $transaction->category->warna ?? '#6b7280' }}20; color: {{ $transaction->category->warna ?? '#6b7280' }}">
                                        {{ $transaction->category->nama ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant font-body-sm">{{ $transaction->note }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-label-sm {{ $transaction->tipe == 'pemasukan' ? 'bg-success/10 text-success' : 'bg-error/10 text-error' }}">
                                        {{ $transaction->tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-headline-sm {{ $transaction->tipe == 'pemasukan' ? 'text-success' : 'text-error' }}">
                                    {{ number_format($transaction->tipe == 'pemasukan' ? $transaction->debit : $transaction->credit, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex gap-1">
                                        <a href="{{ route('keuangan.show', $transaction->id) }}"
                                            class="p-2 text-info hover:bg-info/10 rounded-lg transition-colors"
                                            title="Lihat Detail">
                                            <span class="material-symbols-outlined text-sm">visibility</span>
                                        </a>
                                        @can('admin' , 'bendahara')
                                        <a href="{{ route('keuangan.edit', $transaction->id) }}"
                                            class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors"
                                            title="Edit">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </a>
                                        <form action="{{ route('keuangan.destroy', $transaction->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors"
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($data->hasPages())
        <div class="px-6 py-4 border-t border-outline-variant/10 flex items-center justify-between">
            <p class="text-sm text-on-surface-variant">
                Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} transaksi
            </p>
            <div class="flex gap-2">
                @if($data->onFirstPage())
                    <span class="px-4 py-2 text-on-surface-variant/50 cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $data->previousPageUrl() }}" class="px-4 py-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </a>
                @endif

                <!-- Simple page numbers -->
                @foreach($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                    @if($page == $data->currentPage())
                        <span class="px-4 py-2 bg-primary text-on-primary rounded-lg font-label-sm">{{ $page }}</span>
                    @elseif($page == 1 || $page == $data->lastPage() || ($page >= $data->currentPage() - 2 && $page <= $data->currentPage() + 2))
                        <a href="{{ $url }}" class="px-4 py-2 text-on-surface hover:bg-surface-container rounded-lg font-label-sm">{{ $page }}</a>
                    @elseif($page == $data->currentPage() - 3 || $page == $data->currentPage() + 3)
                        <span class="px-2 text-on-surface-variant">...</span>
                    @endif
                @endforeach

                @if($data->hasMorePages())
                    <a href="{{ $data->nextPageUrl() }}" class="px-4 py-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                @else
                    <span class="px-4 py-2 text-on-surface-variant/50 cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Auto-refresh stats every 30 seconds (optional)
    setInterval(function() {
        // Could implement AJAX refresh here if needed
    }, 30000);
</script>
@endpush
@endsection