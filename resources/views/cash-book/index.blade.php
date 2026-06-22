@extends('layouts.admin')

@section('title', 'Buku Kas')

@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-headline-md text-headline-md text-on-surface">Buku Kas</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Catat dan kelola pemasukan serta pengeluaran pesantren</p>
                    </div>
                    <div class="flex gap-3">
                        @if(auth()->user()->role->name != 'Pengurus')
                        <a href="{{ route('buku-kas.debit.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span>
                            Tambah Pemasukan
                        </a>
                        <a href="{{ route('buku-kas.credit.create') }}" class="bg-secondary text-on-secondary px-4 py-2 rounded-lg font-label-sm hover:bg-secondary/90 transition-colors inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">remove</span>
                            Tambah Pengeluaran
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            @if(Session::has('alert'))
                <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
                    <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
                </div>
            @endif

            <!-- Saldo Card -->
            <div class="cms-card bg-gradient-to-r from-primary to-primary-container rounded-xl p-6 mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-on-primary-fixed font-label-md mb-1">Saldo Kas Saat Ini</p>
                        <p class="text-4xl font-headline-md text-on-primary font-bold">Rp. {{ number_format($balance, 0, ',', '.') }}</p>
                    </div>
                    <span class="material-symbols-outlined text-on-primary text-6xl opacity-50">account_balance_wallet</span>
                </div>
            </div>

            <!-- Search Form -->
            <div class="cms-card bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 mb-6">
                <form method="GET" action="{{ route('buku-kas.index') }}" class="flex gap-3">
                    <div class="flex-1 relative">
                        <span class="material-symbols-outioned absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari berdasarkan tanggal, keterangan, atau jumlah..."
                            class="cms-input w-full pl-10 @error('keyword') border-error @enderror">
                    </div>
                    <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                        Cari
                    </button>
                    @if(request('keyword'))
                    <a href="{{ route('buku-kas.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                        Reset
                    </a>
                    @endif
                </form>
            </div>

            <!-- Transactions Table -->
            <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-surface-container text-on-surface-variant text-xs uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4 text-center font-label-sm">No</th>
                                <th class="px-6 py-4 text-left font-label-sm">Tanggal</th>
                                <th class="px-6 py-4 text-left font-label-sm">Keterangan</th>
                                <th class="px-6 py-4 text-right font-label-sm">Pemasukan</th>
                                <th class="px-6 py-4 text-right font-label-sm">Pengeluaran</th>
                                <th class="px-6 py-4 text-center font-label-sm">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @forelse($data as $index => $cash)
                                <tr class="hover:bg-surface-container/50 transition-colors">
                                    <td class="px-6 py-4 text-center text-on-surface font-body-sm">{{ $index + $data->firstitem() }}</td>
                                    <td class="px-6 py-4 text-on-surface font-body-sm">{{ $cash->date }}</td>
                                    <td class="px-6 py-4 text-on-surface-variant font-body-sm">{{ $cash->note }}</td>
                                    <td class="px-6 py-4 text-right font-body-sm {{ $cash->debit > 0 ? 'text-success' : 'text-on-surface-variant' }}">
                                        @if($cash->debit > 0)
                                            Rp. {{ number_format($cash->debit, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right font-body-sm {{ $cash->credit > 0 ? 'text-error' : 'text-on-surface-variant' }}">
                                        @if($cash->credit > 0)
                                            Rp. {{ number_format($cash->credit, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if(auth()->user()->role->name == 'Pengurus')
                                            <span class="text-warning text-sm font-label-sm">No Action</span>
                                        @else
                                            <button onclick="deleteData('{{ $cash->id }}')"
                                                    class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors"
                                                    title="Hapus">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">receipt_long</span>
                                        <p class="text-on-surface-variant">Belum ada data transaksi kas.</p>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($data->hasPages())
                <div class="px-6 py-4 border-t border-outline-variant/10 flex items-center justify-between">
                    <p class="text-sm text-on-surface-variant">
                        Menampilkan {{ $data->firstitem() ?? 0 }} - {{ $data->lastitem() ?? 0 }} dari {{ $data->total() }} transaksi
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
                                <span class="material-symbols-outined text-sm">chevron_right</span>
                            </a>
                        @else
                            <span class="px-4 py-2 text-on-surface-variant/50 cursor-not-allowed">
                                <span class="material-symbols-outined text-sm">chevron_right</span>
                            </span>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Footer Info -->
                <div class="px-6 py-4 bg-surface-container/50 border-t border-outline-variant/10">
                    <p class="text-sm text-on-surface-variant">
                        Data Keseluruhan: <span class="text-primary font-bold">{{ $data->total() }}</span> data kas telah tercatat
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function deleteData(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data kas ini?')) {
            let url = '{{ route("buku-kas.destroy", ":id") }}';
            url = url.replace(':id', id);

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = url;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endpush