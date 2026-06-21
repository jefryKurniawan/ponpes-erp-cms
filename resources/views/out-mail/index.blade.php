@extends('layouts.admin')
@section('title_page','Data Surat Keluar')
@section('content')
    <!-- Header -->
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">Surat Keluar</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola surat keluar pesantren</p>
            </div>
            <a href="{{ route('surat-keluar.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Tambah Surat Keluar
            </a>
        </div>
    </div>

    @if (Session::has('alert'))
        <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
            <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
        </div>
    @endif

    <!-- Search Form -->
    <div class="cms-card bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 mb-6">
        <form method="GET" action="{{ route('surat-keluar.index') }}" class="flex gap-3">
            <div class="flex-1 relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari berdasarkan no. surat, tanggal, keterangan, pengirim, atau penerima..." class="cms-input w-full pl-10">
            </div>
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">Cari</button>
            @if(request('keyword'))
                <a href="{{ route('surat-keluar.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">Reset</a>
            @endif
        </form>
    </div>

    <!-- Data Table -->
    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container text-on-surface-variant text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-center font-label-sm">No</th>
                        <th class="px-6 py-4 text-left font-label-sm">No. Surat</th>
                        <th class="px-6 py-4 text-left font-label-sm">Tgl. Surat</th>
                        <th class="px-6 py-4 text-left font-label-sm">Keterangan</th>
                        <th class="px-6 py-4 text-left font-label-sm">Pengirim</th>
                        <th class="px-6 py-4 text-left font-label-sm">Penerima</th>
                        <th class="px-6 py-4 text-left font-label-sm">Tgl. Catat</th>
                        <th class="px-6 py-4 text-left font-label-sm">File</th>
                        <th class="px-6 py-4 text-center font-label-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @forelse ($data as $outmail => $result)
                        <tr class="hover:bg-surface-container/50 transition-colors">
                            <td class="px-6 py-4 text-center text-on-surface font-body-sm">{{ $outmail + $data->firstitem() }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm">{{ $result->mail_number }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm">{{ $result->mail_date }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm">{{ $result->note }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm">{{ $result->sender }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm">{{ $result->recipient }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm">{{ $result->record_date }}</td>
                            <td class="px-6 py-4 font-body-sm">
                                @if ($result->file_out == null)
                                    <span class="text-warning text-sm">No File</span>
                                @else
                                    <a href="javascript:void(0)" class="text-primary hover:underline" onclick="viewFile('{{ $result->file_out }}')" data-toggle="modal" data-target="#modalFileOut">
                                        {{ $result->file_out }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('out-mail.edit', $result->id) }}" class="p-2 text-info hover:bg-info/10 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                </a>
                                @if (Auth::user()->role == 'Administrator')
                                    <button onclick="deleteData('{{ $result->id }}')" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-sm">delete</span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">mail</span>
                                <p class="text-on-surface-variant">Belum ada data surat keluar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($data->hasPages())
            <div class="px-6 py-4 border-t border-outline-variant/10 flex items-center justify-between">
                <p class="text-sm text-on-surface-variant">
                    Menampilkan {{ $data->firstitem() ?? 0 }} - {{ $data->lastitem() ?? 0 }} dari {{ $data->total() }} surat
                </p>
                <div class="flex gap-2">
                    {{ $data->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    <!-- Alpine.js Modals -->
    <div x-data="{ showFile:false, fileUrl:'', showDelete:false, deleteUrl:'' }" id="outmail-root">
        <!-- File Modal -->
        <div x-show="showFile" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" @click.away="showFile=false">
            <div class="bg-white rounded-lg overflow-hidden max-w-2xl w-full">
                <div class="flex justify-between items-center p-4 border-b">
                    <h4 class="font-medium">Tampil File Surat Keluar</h4>
                    <button @click="showFile=false" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                </div>
                <div class="p-4">
                    <embed :src="fileUrl" class="w-full h-96" type="application/pdf" />
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDelete" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" @click.away="showDelete=false">
            <div class="bg-white rounded-lg overflow-hidden max-w-md w-full">
                <div class="flex justify-between items-center p-4 border-b">
                    <h4 class="font-medium">Hapus Surat Keluar</h4>
                    <button @click="showDelete=false" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                </div>
                <div class="p-4">
                    <p>Apakah anda yakin?</p>
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
    <!-- Alpine.js functions for modals -->
    <script>
        function viewFile(data) {
            const root = document.getElementById('outmail-root').__x;
            if (root) {
                root.$data.fileUrl = window.location.origin + '/storage/out-mail/' + data;
                root.$data.showFile = true;
            }
        }

        function deleteData(id) {
            const root = document.getElementById('outmail-root').__x;
            if (root) {
                const urlTemplate = '{{ route("surat-keluar.destroy", ":id") }}';
                root.$data.deleteUrl = urlTemplate.replace(':id', id);
                root.$data.showDelete = true;
            }
        }
    </script>
@endsection
