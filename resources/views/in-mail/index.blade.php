@extends('layouts.admin')
@section('title', 'Surat Masuk')
@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-headline-md text-headline-md text-on-surface">Surat Masuk</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola surat masuk pesantren</p>
                </div>
                <div>
                    <a href="{{ route('in-mail.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Tambah Surat Masuk
                    </a>
                </div>
            </div>
        </div>

        @if (Session::has('alert'))
            <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
                <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
            </div>
        @endif

        <!-- Search Form -->
        <div class="cms-card bg-surface-container-lowest rounded-xl p-4 border border-outline-variant/20 mb-6">
            <form method="GET" action="{{ route('in-mail.index') }}" class="flex gap-3">
                <div class="flex-1 relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari berdasarkan no. surat, tanggal, keterangan, pengirim, atau penerima..."
                        class="cms-input w-full pl-10">
                </div>
                <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Cari
                </button>
                @if(request('keyword'))
                <a href="{{ route('in-mail.index') }}" class="border border-outline bg-surface text-on-surface px-6 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                    Reset
                </a>
                @endif
            </form>
        </div>

        <!-- DataTable -->
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
                        @forelse ($data as $inmail => $result)
                        <tr class="hover:bg-surface-container/50 transition-colors">
                            <td class="px-6 py-4 text-center text-on-surface font-body-sm">{{ $inmail + $data->firstitem() }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm">{{ $result->mail_number }}</td>
                            <td class="px-6 py-4 text-on-surface font-body-sm">{{ $result->mail_date }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm>{{ $result->note }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm>{{ $result->sender }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm>{{ $result->recipient }}</td>
                            <td class="px-6 py-4 text-on-surface-variant font-body-sm>{{ $result->record_date }}</td>
                            <td class="px-6 py-4 font-body-sm">
                                @if ($result->file_in == null)
                                    <span class="text-warning text-sm">No File</span>
                                @else
                                    <a href="javascript:void(0)" class="text-primary hover:underline" onclick="viewFile('{{ $result->file_in }}')" data-toggle="modal" data-target="#modalFileIn">
                                        {{ $result->file_in }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('in-mail.edit', $result->id) }}" class="p-2 text-info hover:bg-info/10 rounded-lg transition-colors" title="Edit">
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
                                    <p class="text-on-surface-variant">Belum ada data surat masuk.</p>
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
                    @if($data->onFirstPage())
                        <span class="px-4 py-2 text-on-surface-variant/50 cursor-not-allowed">
                            <span class="material-symbols-outlined text-sm">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" class="px-4 py-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                            <span class="material-symbols-outined text-sm">chevron_left</span>
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
                            <span class="material-symbols-outlined text-sm">chevron_right</span>
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
                    Data Keseluruhan: <span class="text-primary font-bold">{{ $data->total() }}</span> surat masuk tercatat
                </p>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function viewFile(data) {
        let url = window.location.origin+'/storage/in-mail/'+data;
        $('#embed-file').attr('src', url);
    }

    function deleteData(id) {
        if (confirm('Apakah Anda yakin ingin menghapus surat masuk ini?')) {
            let url = '{{ route("in-mail.destroy", ":id") }}';
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

    function formSubmit() {
        $("#deleteForm").submit();
    }
</script>
@endpush