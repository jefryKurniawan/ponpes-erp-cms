@extends('layouts.admin')
@section('title_page','Pembayaran Pendaftaran')
@section('content')
    <!-- Header -->
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-headline-md text-headline-md text-on-surface">Pembayaran Pendaftaran</h2>
            <a href="{{ route('registration.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Bayar Pendaftaran
            </a>
        </div>
    </div>

    @if (Session::has('alert'))
        <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
            <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
        </div>
    @endif

    <!-- Year Filter -->
    <div class="cms-card bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 mb-6">
        <form method="GET" action="{{ route('registration.index') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <select name="year" class="cms-input w-full pl-10">
                    @for ($year = (int) date('Y'); $year >= 1900; $year--)
                        <option value="{{ $year }}" @if ($year == $now) selected @endif>{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">Cari</button>
            @if(request('year'))
                <a href="{{ route('registration.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">Reset</a>
            @endif
        </form>
    </div>

    <!-- Tabel Registrasi -->
    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container text-on-surface-variant text-xs uppercase tracking-wider">
                    <tr class="text-center">
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Alamat</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse ($data as $i => $reg)
                        <tr class="hover:bg-surface-container/50 transition-colors">
                            <td class="px-6 py-4 text-center font-body-sm">{{ $i + $data->firstitem() }}</td>
                            <td class="px-6 py-4 font-body-sm"><a href="{{ route('santri.show',$reg->santris->id) }}" class="text-primary hover:underline">{{ $reg->santris->name }}</a></td>
                            <td class="px-6 py-4 font-body-sm">{{ $reg->santris->address }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('registration.print', $reg->id) }}" class="p-2 text-info hover:bg-info/10 rounded-lg transition-colors" title="Cetak"><span class="material-symbols-outlined text-sm">print</span></a>
                                @if (auth()->user()->role == 'Administrator')
                                    <button onclick="deleteData('{{ $reg->id }}')" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus"><span class="material-symbols-outlined text-sm">delete</span></button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">people</span>
                                <p class="text-on-surface-variant">Belum ada data pendaftaran.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($data->hasPages())
            <div class="px-6 py-4 border-t border-outline-variant/10 flex items-center justify-between">
                <p class="text-sm text-on-surface-variant">
                    Menampilkan {{ $data->firstitem() ?? 0 }} - {{ $data->lastitem() ?? 0 }} dari {{ $data->total() }} pendaftaran
                </p>
                <div class="flex gap-2">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    <!-- Delete Confirmation (Alpine) -->
    <div x-data="{showDelete:false, deleteUrl:''}" id="registration-root">
        <div x-show="showDelete" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" @click.away="showDelete=false">
            <div class="bg-white rounded-lg overflow-hidden max-w-md w-full">
                <div class="flex justify-between items-center p-4 border-b">
                    <h4 class="font-medium">Hapus Pendaftaran</h4>
                    <button @click="showDelete=false" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                </div>
                <div class="p-4">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="flex justify-end p-4 border-t space-x-2">
                    <button @click="showDelete=false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                    <form :action="deleteUrl" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteData(id) {
            const root = document.getElementById('registration-root').__x;
            if (root) {
                const tmpl = '{{ route("registration.destroy", ":id") }}';
                root.$data.deleteUrl = tmpl.replace(':id', id);
                root.$data.showDelete = true;
            }
        }
    </script>
@endsection