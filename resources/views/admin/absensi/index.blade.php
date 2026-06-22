@extends('layouts.admin')

@section('title', 'Absensi Santri')

@section('content')
@if (session('success'))
    <div x-data="{show:true}" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2 z-50">
        <span class="material-symbols-outlined">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <header class="mb-lg">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-xs">Absensi Santri</h2>
            <p class="font-body-md text-on-surface-variant">
                @php $total = $absensis->count() + $santris->count(); $sudah = $absensis->count(); @endphp
                Progress: {{ $sudah }} dari {{ $total }} santri
                <span class="ml-sm px-sm py-xs rounded-full text-xs font-label-sm
                    {{ $sudah === $total ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ $sudah === $total ? '✓ Lengkap' : ($sudah === 0 ? '○ Belum diisi' : '● Sebagian') }}
                </span>
            </p>
        </header>

        <div class="cms-card overflow-hidden">
            <div class="p-lg border-b border-divider-clay bg-surface-container-lowest flex flex-wrap gap-md items-center">
                <form method="GET" action="{{ route('absensi.index') }}" class="flex items-center gap-sm">
                    <label class="font-label-md text-on-surface-variant">Tanggal:</label>
                    <input type="date" name="tanggal" value="{{ $tanggal }}"
                           class="rounded-lg border-outline bg-surface font-body-md p-sm"/>
                    <button type="submit" class="bg-primary text-on-primary px-md py-xs rounded-lg font-label-md hover:opacity-90 transition-opacity flex items-center gap-xs">
                        <span class="material-symbols-outlined text-sm">refresh</span>
                        <span class="hidden sm:inline">Refresh</span>
                    </button>
                </form>
                @if($sudah > 0)
                    <button type="button" onclick="submitBulk()" class="bg-primary text-on-primary px-md py-xs rounded-lg font-label-md hover:opacity-90 transition-opacity flex items-center gap-xs">
                        <span class="material-symbols-outlined text-sm">check</span>
                        Simpan
                    </button>
                @endif
                <button onclick="toggleForm()" class="bg-secondary-container text-on-secondary-container px-md py-xs rounded-lg font-label-md hover:bg-secondary-container/80 transition-colors flex items-center gap-xs">
                    <span class="material-symbols-outlined text-sm">person_add</span> Input Manual
                </button>
            </div>

            <div class="p-lg">
                @if($absensis->isNotEmpty())
                    <form id="bulk-form" action="{{ route('absensi.bulk-update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                        <div class="space-y-md mb-lg">
                            <div class="flex items-center gap-sm text-sm">
                                <span class="material-symbols-outlined text-primary" style="font-size:18px;">info</span>
                                <span class="text-on-surface-variant">Pilih status untuk setiap santri, lalu klik <strong>Simpan</strong></span>
                            </div>
                            <div class="flex gap-sm text-xs">
                                <span class="px-sm py-xs rounded bg-green-100 text-green-800 flex items-center gap-xs">
                                    <span class="w-2 h-2 rounded-full bg-green-600"></span> Hadir
                                </span>
                                <span class="px-sm py-xs rounded bg-yellow-100 text-yellow-800 flex items-center gap-xs">
                                    <span class="w-2 h-2 rounded-full bg-yellow-600"></span> Sakit
                                </span>
                                <span class="px-sm py-xs rounded bg-orange-100 text-orange-800 flex items-center gap-xs">
                                    <span class="w-2 h-2 rounded-full bg-orange-600"></span> Izin
                                </span>
                                <span class="px-sm py-xs rounded bg-red-100 text-red-800 flex items-center gap-xs">
                                    <span class="w-2 h-2 rounded-full bg-red-600"></span> Alfa
                                </span>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="border-b border-divider-clay">
                                        <th class="font-label-md text-on-surface-variant py-md pr-md">No</th>
                                        <th class="font-label-md text-on-surface-variant py-md pr-md">Nama Santri</th>
                                        <th class="font-label-md text-on-surface-variant py-md pr-md text-center">
                                            Pagi
                                            <span class="block text-xs font-body-sm text-on-surface-variant">Hadiri/Sakit/Izin/Alfa</span>
                                        </th>
                                        <th class="font-label-md text-on-surface-variant py-md pr-md text-center">
                                            Sore
                                            <span class="block text-xs font-body-sm text-on-surface-variant">Hadiri/Sakit/Izin/Alfa</span>
                                        </th>
                                        <th class="font-label-md text-on-surface-variant py-md pr-md">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($absensis as $idx => $absen)
                                        <tr class="border-b border-divider-clay hover:bg-surface-container-low transition-colors">
                                            <td class="py-md pr-md font-body-md">{{ $idx + 1 }}</td>
                                            <td class="py-md pr-md font-body-md">{{ $absen->santri->nama }}</td>
                                            <td class="py-md pr-md text-center">
                                                <select name="absence[{{ $idx }}][pagi]" data-absensi
                                                        class="rounded-lg border-outline bg-surface font-body-sm p-xs text-center min-w-24 cursor-pointer
                                                               {{ $absen->pagi === 'hadir' ? 'bg-green-100' : ($absen->pagi === 'sakit' ? 'bg-yellow-100' : ($absen->pagi === 'izin' ? 'bg-orange-100' : 'bg-red-100')) }}">
                                                    <option value="hadir" {{ $absen->pagi === 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                    <option value="sakit" {{ $absen->pagi === 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                    <option value="izin" {{ $absen->pagi === 'izin' ? 'selected' : '' }}>Izin</option>
                                                    <option value="alfa" {{ $absen->pagi === 'alfa' ? 'selected' : '' }}>Alfa</option>
                                                </select>
                                            </td>
                                            <td class="py-md pr-md text-center">
                                                <select name="absence[{{ $idx }}][sore]" data-absensi
                                                        class="rounded-lg border-outline bg-surface font-body-sm p-xs text-center min-w-24 cursor-pointer
                                                               {{ $absen->sore === 'hadir' ? 'bg-green-100' : ($absen->sore === 'sakit' ? 'bg-yellow-100' : ($absen->sore === 'izin' ? 'bg-orange-100' : 'bg-red-100')) }}">
                                                    <option value="hadir" {{ $absen->sore === 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                    <option value="sakit" {{ $absen->sore === 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                    <option value="izin" {{ $absen->sore === 'izin' ? 'selected' : '' }}>Izin</option>
                                                    <option value="alfa" {{ $absen->sore === 'alfa' ? 'selected' : '' }}>Alfa</option>
                                                </select>
                                            </td>
                                            <td class="py-md pr-md">
                                                <input type="text" name="absence[{{ $idx }}][keterangan]"
                                                       value="{{ $absen->keterangan ?? '' }}"
                                                       placeholder="Opsional"
                                                       class="w-full rounded-lg border-outline bg-surface font-body-sm p-xs"/>
                                                <input type="hidden" name="absence[{{ $idx }}][santri_id]" value="{{ $absen->santri_id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                @elseif($santris->isEmpty())
                    <div class="text-center py-lg">
                        <span class="material-symbols-outlined text-green-600 scale-[2]" style="font-size: 48px;">check_circle</span>
                        <p class="font-body-md text-on-surface mt-md font-medium">Semua santri sudah memiliki absensi</p>
                        <p class="font-body-sm text-on-surface-variant">Tidak ada santri yang perlu ditambahkan untuk tanggal {{ $tanggal }}</p>
                    </div>
                @endif

                @if($santris->isNotEmpty())
                    <div class="mt-xl pt-lg border-t-2 border-divider-clay">
                        <div class="flex items-center gap-sm mb-sm">
                            <span class="material-symbols-outlined text-secondary">group_add</span>
                            <h4 class="font-label-md text-secondary">{{ $santris->count() }} santri belum terisi absensinya</h4>
                        </div>
                        <p class="font-body-sm text-on-surface-variant mb-md">
                            Tambahkan absensi individual untuk santri yang tidak hadir pada saat input massal
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-sm">
                            @foreach($santris as $santri)
                                <button onclick="quickAdd('{{ $santri->id }}', '{{ $santri->nama }}')"
                                        class="cms-card p-sm flex items-center justify-between hover:bg-primary-container/10 hover:border-primary transition-all cursor-pointer text-left w-full">
                                    <span class="font-body-sm truncate text-on-surface">{{ $santri->nama }}</span>
                                    <span class="material-symbols-outlined text-primary text-sm">add_circle</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<!-- Quick Add Modal -->
<div id="quick-add-modal" class="hidden fixed inset-0 z-[100] items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-surface rounded-xl p-lg max-w-md w-full mx-4 shadow-2xl">
        <h4 class="font-headline-sm text-on-surface mb-sm">Tambah Absensi Manual</h4>
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
            <input type="hidden" name="santri_id" id="modal-santri-id">
            <p class="font-body-md text-on-surface-variant mb-md" id="modal-santri-nama"></p>

            <div class="space-y-sm">
                <div class="grid grid-cols-2 gap-sm">
                    <div>
                        <label class="font-label-sm text-on-surface-variant">Pagi</label>
                        <select name="pagi" class="mt-xs w-full rounded-lg border-outline bg-surface font-body-md p-sm">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alfa">Alfa</option>
                        </select>
                    </div>
                    <div>
                        <label class="font-label-sm text-on-surface-variant">Sore</label>
                        <select name="sore" class="mt-xs w-full rounded-lg border-outline bg-surface font-body-md p-sm">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alfa">Alfa</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="font-label-sm text-on-surface-variant">Keterangan</label>
                    <textarea name="keterangan" rows="2" class="mt-xs w-full rounded-lg border-outline bg-surface font-body-md p-sm"></textarea>
                </div>
            </div>

            <div class="mt-lg flex justify-end gap-sm">
                <button type="button" onclick="closeModal()" class="px-md py-xs rounded-lg font-label-sm bg-surface-container-high text-on-surface hover:bg-surface-container-highest transition-colors">Batal</button>
                <button type="submit" class="px-md py-xs rounded-lg font-label-sm bg-primary text-on-primary hover:opacity-90 transition-opacity">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleForm() {
    document.querySelector('.grid.grid-cols-1')?.scrollIntoView({ behavior: 'smooth' });
}

function quickAdd(id, nama) {
    document.getElementById('modal-santri-id').value = id;
    document.getElementById('modal-santri-nama').textContent = 'Santri: ' + nama;
    document.getElementById('quick-add-modal').classList.remove('hidden');
    document.getElementById('quick-add-modal').classList.add('flex');
}

function closeModal() {
    document.getElementById('quick-add-modal').classList.add('hidden');
    document.getElementById('quick-add-modal').classList.remove('flex');
}

function submitBulk() {
    if (confirm('Simpan absensi untuk tanggal ini?')) {
        document.getElementById('bulk-form').submit();
    }
}

document.getElementById('quick-add-modal')?.addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Auto-color on load and change
function updateColor(select) {
    select.classList.remove('bg-green-100', 'bg-yellow-100', 'bg-orange-100', 'bg-red-100');
    if (select.value === 'hadir') select.classList.add('bg-green-100');
    else if (select.value === 'sakit') select.classList.add('bg-yellow-100');
    else if (select.value === 'izin') select.classList.add('bg-orange-100');
    else if (select.value === 'alfa') select.classList.add('bg-red-100');
}

document.querySelectorAll('select[data-absensi]').forEach(select => {
    updateColor(select); // color on load
    select.addEventListener('change', function() { updateColor(this); });
});
</script>
@endsection