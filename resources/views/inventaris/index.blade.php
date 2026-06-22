@extends('layouts.admin')
@section('title_page','Inventaris')
@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <!-- Header -->
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-headline-md text-headline-md text-on-surface">Inventaris</h2>
                <a href="{{ route('inventaris.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Tambah Item
                </a>
            </div>
            @if (Session::has('alert'))
                <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
                    <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
                </div>
            @endif
        </div>

        <!-- Search Form -->
        <div class="cms-card bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 mb-6">
            <form method="GET" action="{{ route('inventaris.index') }}" class="flex gap-3">
                <div class="flex-1 relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama barang, kode, atau lokasi..." class="cms-input w-full pl-10">
                </div>
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Cari
                </button>
                @if(request('keyword'))
                <a href="{{ route('inventaris.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                    Reset
                </a>
            @endif
            </form>
        </div>

        <!-- Data Table (placeholder) -->
        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-surface-container text-on-surface-variant text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-center font-label-sm">#</th>
                            <th class="px-6 py-4 text-left font-label-sm">Nama Barang</th>
                            <th class="px-6 py-4 text-left font-label-sm">Kode</th>
                            <th class="px-6 py-4 text-left font-label-sm">Lokasi</th>
                            <th class="px-6 py-4 text-center font-label-sm">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @forelse ($items ?? [] as $i => $item)
                        <tr class="hover:bg-surface-container/50 transition-colors">
                            <td class="px-6 py-4 text-center text-on-surface font-body-sm">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm>{{ $item->name ?? 'Item '.$i }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm>{{ $item->code ?? '-' }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm>{{ $item->location ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('inventaris.edit', $item->id ?? $i) }}" class="p-2 text-info hover:bg-info/10 rounded-lg transition-colors" title="Edit"><span class="material-symbols-outlined text-sm">edit</span></a>
                                <button class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus"><span class="material-symbols-outlined text-sm">delete</span></button>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">inventory_2</span>
                                    <p class="text-on-surface-variant">Belum ada data inventaris.</p>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination placeholder -->
            @if(isset($items) && $items instanceof \Illuminate\Pagination\LengthAwarePaginator && $items->hasPages())
                <div class="px-6 py-4 border-t border-outline-variant/10 flex items-center justify-between">
                    <p class="text-sm text-on-surface-variant">
                        Menampilkan {{ $items->firstItem() ?? 0 }} - {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} barang
                    </p>
                    <div class="flex gap-2">
                        {{ $items->links('pagination::tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection