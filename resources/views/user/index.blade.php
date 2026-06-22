@extends('layouts.admin')

@section('title', 'Data Pengguna')

@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        @if (session('success'))
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-headline-md text-headline-md text-on-surface">Data Pengguna</h2>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola pengguna sistem pesantren</p>
                </div>
                <a href="{{ route('pengguna.create') }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Tambah Pengguna
                </a>
            </div>
        </div>

        @if(Session::has('alert'))
            <div class="mb-6 rounded-lg border border-warning bg-warning-container/10 p-4">
                <p class="font-body-sm text-warning">{{ Session('alert') }}</p>
            </div>
        @endif

        <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden mb-6">
            <div class="p-4 border-b border-outline-variant/10">
                <form action="#" method="GET" class="flex gap-3">
                    <input type="text" name="keyword" class="cms-input flex-1" placeholder="Cari pengguna..." value="{{ Request::get('keyword') }}">
                    <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined text-sm">search</span>
                    </button>
                    <a href="{{ route('pengguna.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-sm">refresh</span>
                    </a>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-surface-container text-on-surface-variant">
                        <tr>
                            <th class="px-4 py-3 text-center font-label-sm" width="5%">No</th>
                            <th class="px-4 py-3 text-left font-label-sm">Nama</th>
                            <th class="px-4 py-3 text-left font-label-sm">Email</th>
                            <th class="px-4 py-3 text-left font-label-sm">Role</th>
                            <th class="px-4 py-3 text-center font-label-sm" width="13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/10">
                        @foreach($data as $user)
                            <tr class="hover:bg-surface-container/50 transition-colors">
                                <td class="px-4 py-3 text-center text-on-surface-variant">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">
                                    @if($user->santris)
                                        <a href="{{ route('santri.show', $user->santris->id) }}" class="text-primary hover:text-primary/80 font-medium">{{ $user->santris->name }}</a>
                                    @else
                                        <span class="text-on-surface-variant italic">Tidak ada profil santri</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-on-surface">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs bg-surface-container text-on-surface-variant">
                                        {{ $user->role->display_name }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if(Auth::user()->role && Auth::user()->role->name == 'Pengurus')
                                        <span class="text-warning text-sm">No Action</span>
                                    @else
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pengguna.edit', $user->id) }}" class="text-info hover:text-info/80 transition-colors" title="Edit">
                                                <span class="material-symbols-outlined text-sm">edit</span>
                                            </a>
                                            <button type="button" class="text-error hover:text-error/80 transition-colors" title="Hapus" onclick="deleteData('{{ $user->id }}')">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if($data->isEmpty())
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Tidak ada data pengguna.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <span class="text-on-surface-variant text-sm">
                Data Keseluruhan: <span class="font-label-md text-primary font-medium">{{ \App\Models\User::count() }}</span> pengguna.
            </span>
            @if($data->hasPages())
                <div>
                    {{ $data->links() }}
                </div>
            @endif
        </div>
    </div>
</main>

<!-- Modal Delete -->
<div class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center" id="deleteSuratModal" data-modal-overlay>
    <div class="bg-surface rounded-xl p-6 max-w-md mx-4 shadow-xl" role="dialog">
        <form action="javascript:void(0)" id="deleteForm" method="post">
            @method('DELETE')
            @csrf
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-headline-sm text-headline-sm text-on-surface">Hapus Pengguna</h4>
                <button type="button" class="text-on-surface-variant hover:text-on-surface" onclick="closeModal()">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-on-surface-variant">Apakah Anda yakin ingin menghapus pengguna ini?</p>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors" onclick="closeModal()">
                    Batal
                </button>
                <button type="submit" class="bg-error text-on-error px-4 py-2 rounded-lg font-label-sm hover:bg-error/90 transition-colors">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function deleteData(id) {
        let url = '{{ route("pengguna.destroy", ":id") }}';
        url = url.replace(':id', id);
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteSuratModal').classList.remove('hidden');
        document.getElementById('deleteSuratModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('deleteSuratModal').classList.add('hidden');
        document.getElementById('deleteSuratModal').classList.remove('flex');
    }

    // Close modal on outside click
    document.addEventListener('click', function(event) {
        let modal = document.getElementById('deleteSuratModal');
        if (event.target === modal) {
            closeModal();
        }
    });
</script>
@endpush
@endsection