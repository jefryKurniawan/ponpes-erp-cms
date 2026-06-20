@extends('layouts.admin')

@section('title', $santri->name . ' | Detail Santri')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface">{{ $santri->name }}</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Detail informasi santri</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('santri.index') }}" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors">
                    Kembali
                </a>
                @can('admin', 'bendahara')
                <a href="{{ route('santri.edit', $santri->id) }}" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Edit Profil
                </a>
                @endcan
            </div>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden mb-6">
        <div class="bg-primary/10 p-6 border-b border-outline-variant/10">
            <div class="flex items-center gap-6">
                <div>
                    @if($santri->photo != null)
                        <img src="{{ '/storage/photo/' . $santri->photo }}" alt="Profile Image" class="w-32 h-32 rounded-full object-cover border-4 border-primary/20" onerror="this.src='{{ asset('assets/img/avatar/avatar-1.png') }}'">
                    @else
                        <img alt="Profile Image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="w-32 h-32 rounded-full object-cover border-4 border-primary/20">
                    @endif
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md text-on-surface">{{ $santri->name }}</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $santri->birth_place }}, {{ \Carbon\Carbon::parse($santri->birth_date)->isoFormat('D MMMM Y') }}</p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">{{ $santri->phone }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-label-xs mt-2 {{ $santri->year_out ? 'bg-surface-container text-on-surface-variant' : 'bg-success/10 text-success' }}">
                        {{ $santri->year_out ? 'Lulus' : 'Aktif' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <h4 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Pribadi</h4>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Nama</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->name }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Tempat, Tgl Lahir</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->birth_place }}, {{ \Carbon\Carbon::parse($santri->birth_date)->isoFormat('D MMMM Y') }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10 md:col-span-2">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Alamat</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->address }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">No. HP</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->phone }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Asal Sekolah</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->school_old }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10 md:col-span-2">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Alamat Asal Sekolah</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->school_address_old }}</dd>
                </div>
            </dl>
        </div>

        <div class="p-6 border-t border-outline-variant/10">
            <h4 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Sekolah</h4>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Sekolah Sekarang</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->school_current }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10 md:col-span-2">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Alamat Sekolah Sekarang</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->school_address_current }}</dd>
                </div>
            </dl>
        </div>

        <div class="p-6 border-t border-outline-variant/10">
            <h4 class="font-headline-sm text-headline-sm text-on-surface mb-4">Informasi Orang Tua</h4>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3">
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Nama Ayah</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->father_name }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Pekerjaan Ayah</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->father_job }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Nama Ibu</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->mother_name }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Pekerjaan Ibu</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->mother_job }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">No. HP Orang Tua</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->parent_phone }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Tahun Masuk</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->entry_year }}</dd>
                </div>
                <div class="flex py-2 border-b border-outline-variant/10">
                    <dt class="w-40 font-label-sm text-on-surface-variant">Tahun Keluar</dt>
                    <dd class="text-on-surface flex-1">{{ $santri->year_out ?: '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Riwayat Kelas -->
    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-outline-variant/10 flex items-center justify-between">
            <h3 class="font-headline-sm text-headline-sm text-on-surface">Riwayat Kelas</h3>
            @can('admin')
            <button type="button" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors" onclick="openModal('tambahKelasModal')">
                <span class="material-symbols-outlined text-sm align-text-bottom mr-1">add</span>
                Tambah Kelas
            </button>
            @endcan
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container text-on-surface-variant">
                    <tr>
                        <th class="px-4 py-3 text-left font-label-sm">Tahun Ajaran</th>
                        <th class="px-4 py-3 text-left font-label-sm">Nama Kelas</th>
                        <th class="px-4 py-3 text-left font-label-sm">Wali Kelas</th>
                        <th class="px-4 py-3 text-left font-label-sm">Masuk Kelas</th>
                        <th class="px-4 py-3 text-left font-label-sm">Keluar Kelas</th>
                        <th class="px-4 py-3 text-right font-label-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @if($santri->kelas->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada riwayat kelas.</td>
                        </tr>
                    @else
                        @foreach($santri->kelas as $kelas)
                            <tr class="hover:bg-surface-container/50 transition-colors">
                                <td class="px-4 py-3 text-on-surface">{{ $kelas->pivot->tahun_ajaran }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $kelas->nama }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $kelas->wali_kelas ?? '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $kelas->pivot->masuk_kelas ? \Carbon\Carbon::parse($kelas->pivot->masuk_kelas)->isoFormat('D MMMM Y') : '-' }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $kelas->pivot->keluar_kelas ? \Carbon\Carbon::parse($kelas->pivot->keluar_kelas)->isoFormat('D MMMM Y') : '-' }}</td>
                                <td class="px-4 py-3 text-right">
                                    @can('admin')
                                    <form action="{{ route('santri.destroyKelas', [$santri->id, $kelas->pivot->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-error hover:text-error/80 transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat kelas ini?')">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Nilai -->
    <div class="cms-card bg-surface-container-lowest rounded-xl border border-outline-variant/20 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-outline-variant/10 flex items-center justify-between">
            <h3 class="font-headline-sm text-headline-sm text-on-surface">Riwayat Nilai</h3>
            @can('admin')
            <button type="button" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors" onclick="openModal('tambahNilaiModal')">
                <span class="material-symbols-outlined text-sm align-text-bottom mr-1">add</span>
                Tambah Nilai
            </button>
            @endcan
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-container text-on-surface-variant">
                    <tr>
                        <th class="px-4 py-3 text-left font-label-sm">Mata Pelajaran</th>
                        <th class="px-4 py-3 text-left font-label-sm">Nilai</th>
                        <th class="px-4 py-3 text-left font-label-sm">Semester</th>
                        <th class="px-4 py-3 text-left font-label-sm">Tahun Ajaran</th>
                        <th class="px-4 py-3 text-left font-label-sm">Keterangan</th>
                        <th class="px-4 py-3 text-right font-label-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @if($santri->nilai->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada nilai.</td>
                        </tr>
                    @else
                        @foreach($santri->nilai as $nilai)
                            <tr class="hover:bg-surface-container/50 transition-colors">
                                <td class="px-4 py-3 text-on-surface">{{ $nilai->mapel->nama }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-label-xs {{ $nilai->nilai >= 75 ? 'bg-success/10 text-success' : ($nilai->nilai >= 60 ? 'bg-warning/10 text-warning' : 'bg-error/10 text-error') }}">
                                        {{ number_format($nilai->nilai, 2, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $nilai->semester }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $nilai->tahun_ajaran }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $nilai->keterangan ?? '-' }}</td>
                                <td class="px-4 py-3 text-right">
                                    @can('admin')
                                    <form action="{{ route('santri.destroyNilai', $nilai->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-error hover:text-error/80 transition-colors" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kelas -->
<div class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center" id="tambahKelasModal" data-modal-overlay>
    <div class="bg-surface rounded-xl p-6 max-w-md mx-4 shadow-xl max-h-[90vh] overflow-y-auto" role="dialog">
        <form action="{{ route('santri.storeKelas', $santri->id) }}" method="POST">
            @csrf
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-headline-sm text-headline-sm text-on-surface">Tambah Kelas Santri</h4>
                <button type="button" class="text-on-surface-variant hover:text-on-surface" onclick="closeModal('tambahKelasModal')">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label for="kelas_id" class="block font-label-sm text-on-surface mb-2">Kelas</label>
                    <select class="cms-input w-full" id="kelas_id" name="kelas_id" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama }} ({{ $kelas->tahun_ajaran }} {{ $kelas->semester }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tahun_ajaran" class="block font-label-sm text-on-surface mb-2">Tahun Ajaran</label>
                    <input type="text" class="cms-input w-full" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $santri->entry_year ?? date('Y')) }}" required>
                </div>
                <div>
                    <label for="masuk_kelas" class="block font-label-sm text-on-surface mb-2">Tanggal Masuk Kelas</label>
                    <input type="date" class="cms-input w-full" id="masuk_kelas" name="masuk_kelas">
                </div>
                <div>
                    <label for="keluar_kelas" class="block font-label-sm text-on-surface mb-2">Tanggal Keluar Kelas</label>
                    <input type="date" class="cms-input w-full" id="keluar_kelas" name="keluar_kelas">
                </div>
                @if ($errors->any())
                    <div class="rounded-lg border border-error bg-error-container/10 p-3">
                        <ul class="list-disc list-inside text-error text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="flex gap-3 justify-end mt-6">
                <button type="button" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors" onclick="closeModal('tambahKelasModal')">
                    Batal
                </button>
                <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Nilai -->
<div class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center" id="tambahNilaiModal" data-modal-overlay>
    <div class="bg-surface rounded-xl p-6 max-w-md mx-4 shadow-xl max-h-[90vh] overflow-y-auto" role="dialog">
        <form action="{{ route('santri.storeNilai', $santri->id) }}" method="POST">
            @csrf
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-headline-sm text-headline-sm text-on-surface">Tambah Nilai Santri</h4>
                <button type="button" class="text-on-surface-variant hover:text-on-surface" onclick="closeModal('tambahNilaiModal')">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="space-y-4">
                <div>
                    <label for="mapel_id" class="block font-label-sm text-on-surface mb-2">Mata Pelajaran</label>
                    <select class="cms-input w-full" id="mapel_id" name="mapel_id" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($mapelList as $mapel)
                            <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nilai" class="block font-label-sm text-on-surface mb-2">Nilai (0-100)</label>
                    <input type="number" class="cms-input w-full" id="nilai" name="nilai" min="0" max="100" step="0.01" required>
                </div>
                <div>
                    <label for="semester" class="block font-label-sm text-on-surface mb-2">Semester</label>
                    <select class="cms-input w-full" id="semester" name="semester" required>
                        <option value="">Pilih Semester</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                </div>
                <div>
                    <label for="tahun_ajaran" class="block font-label-sm text-on-surface mb-2">Tahun Ajaran</label>
                    <input type="text" class="cms-input w-full" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $santri->entry_year ?? date('Y')) }}" required>
                </div>
                <div>
                    <label for="keterangan" class="block font-label-sm text-on-surface mb-2">Keterangan</label>
                    <textarea class="cms-input w-full" id="keterangan" name="keterangan" rows="3"></textarea>
                </div>
                @if ($errors->any())
                    <div class="rounded-lg border border-error bg-error-container/10 p-3">
                        <ul class="list-disc list-inside text-error text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="flex gap-3 justify-end mt-6">
                <button type="button" class="border border-outline bg-surface text-on-surface px-4 py-2 rounded-lg font-label-sm hover:bg-surface-container transition-colors" onclick="closeModal('tambahNilaiModal')">
                    Batal
                </button>
                <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-lg font-label-sm hover:bg-primary/90 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close modal on outside click
    document.addEventListener('click', function(event) {
        if (event.target.hasAttribute('data-modal-overlay')) {
            closeModal(event.target.id);
        }
    });
</script>
@endpush
@endsection