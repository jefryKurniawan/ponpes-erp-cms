@extends('layouts.home')
@section('title_page','Tampil Data Santri')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="form-group">
                    @if ($santri->photo != null)
                        <img src="{{ '/storage/photo/' . $santri->photo }}" alt="Profile Image Santri" class="rounded-circle" width="200"
                        style="position: relative;width: 200px;height: 200px;overflow: hidden;">
                    @else
                        <img alt="Profile Image Santri" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle" width="200">
                    @endif
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-info"><i class="fas fa-pen"></i>  &nbsp;&nbsp;Edit Profil</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="name">Nama Santri</label>
                    <h4>{{ $santri->name }}</h4>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="birth_place">Tempat Lahir Santri</label>
                    <h4>{{ $santri->birth_place }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir Santri</label>
                    <h4>{{ \Carbon\Carbon::parse($santri->birth_date)->isoFormat('D MMMM Y') }}</h4>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="phone">No. HP Santri</label>
                    <h4>{{ $santri->phone }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="address">Alamat Santri</label>
                    <h4>{{ $santri->address }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="school_old">Asal Sekolah Santri</label>
                    <h4>{{ $santri->school_old }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="school_address_old">Alamat Asal Sekolah Santri</label>
                    <h4>{{ $santri->school_address_old }}</h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="school_current">Sekolah Sekarang Santri</label>
                    <h4>{{ $santri->school_current }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="school_address_current">Alamat Sekolah Sekarang Santri</label>
                    <h4>{{ $santri->school_address_current }}</h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="father_job">Pekerjaan Ayah Santri</label>
                    <h4>{{ $santri->father_job }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="father_name">Nama Ayah Santri</label>
                    <h4>{{ $santri->father_name }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="mother_name">Nama Ibu Santri</label>
                    <h4>{{ $santri->mother_name }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="mother_job">Pekerjaan Ibu Santri</label>
                    <h4>{{ $santri->mother_job }}</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label for="parent_phone">No. HP Orang Tua Santri</label>
                    <h4>{{ $santri->parent_phone }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="entry_year">Tahun Masuk</label>
                    <h4>{{ $santri->entry_year }}</h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="year_out">Tahun Keluar</label>
                    <h4>{{ $santri->year_out ?: "-" }}</h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="status">Status</label>
                    <h4>{{ $santri->year_out ? 'Lulus' : 'Aktif' }}</h4>
                </div>
            </div>
        </div>

        <!-- Riwayat Kelas -->
        <hr>
        <h3>Riwayat Kelas</h3>
        @can('admin')
        <a href="#" class="btn btn-sm btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahKelasModal">
            <i class="fas fa-plus"></i> Tambah Kelas
        </a>
        @endcan
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Nama Kelas</th>
                        <th>Wali Kelas</th>
                        <th>Masuk Kelas</th>
                        <th>Keluar Kelas</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($santri->kelas->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada riwayat kelas.</td>
                        </tr>
                    @else
                        @foreach($santri->kelas as $kelas)
                            <tr>
                                <td>{{ $kelas->pivot->tahun_ajaran }}</td>
                                <td>{{ $kelas->nama }}</td>
                                <td>{{ $kelas->wali_kelas ?? '-' }}</td>
                                <td>{{ $kelas->pivot->masuk_kelas ? \Carbon\Carbon::parse($kelas->pivot->masuk_kelas)->isoFormat('D MMMM Y') : '-' }}</td>
                                <td>{{ $kelas->pivot->keluar_kelas ? \Carbon\Carbon::parse($kelas->pivot->keluar_kelas)->isoFormat('D MMMM Y') : '-' }}</td>
                                <td class="text-end">
                                    @can('admin')
                                    <form action="{{ route('santri.destroyKelas', [$santri->id, $kelas->pivot->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat kelas ini?')">
                                            <i class="bi bi-trash"></i>
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

        <!-- Riwayat Nilai -->
        <hr>
        <h3>Riwayat Nilai</h3>
        @can('admin')
        <a href="#" class="btn btn-sm btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahNilaiModal">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>
        @endcan
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Keterangan</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($santri->nilai->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada nilai.</td>
                        </tr>
                    @else
                        @foreach($santri->nilai as $nilai)
                            <tr>
                                <td>{{ $nilai->mapel->nama }}</td>
                                <td>{{ number_format($nilai->nilai, 2, ',', '.') }}</td>
                                <td>{{ $nilai->semester }}</td>
                                <td>{{ $nilai->tahun_ajaran }}</td>
                                <td>{{ $nilai->keterangan ?? '-' }}</td>
                                <td class="text-end">
                                    @can('admin')
                                    <form action="{{ route('santri.destroyNilai', $nilai->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">
                                            <i class="bi bi-trash"></i>
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

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="tambahKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('santri.storeKelas', $santri->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahKelasModalLabel">Tambah Kelas Santri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_id" name="kelas_id" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama }} ({{ $kelas->tahun_ajaran }} {{ $kelas->semester }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $santri->tahun_berdiri ?? date('Y')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="masuk_kelas" class="form-label">Tanggal Masuk Kelas</label>
                            <input type="date" class="form-control" id="masuk_kelas" name="masuk_kelas">
                        </div>
                        <div class="mb-3">
                            <label for="keluar_kelas" class="form-label">Tanggal Keluar Kelas</label>
                            <input type="date" class="form-control" id="keluar_kelas" name="keluar_kelas">
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Nilai -->
    <div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="tambahNilaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('santri.storeNilai', $santri->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahNilaiModalLabel">Tambah Nilai Santri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="mapel_id" class="form-label">Mata Pelajaran</label>
                            <select class="form-select" id="mapel_id" name="mapel_id" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($mapelList as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai (0-100)</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" min="0" max="100" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ old('tahun_ajaran', $santri->tahun_berdiri ?? date('Y')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // For modals to load fresh data each time (optional)
    $('#tambahKelasModal').on('show.bs.modal', function () {
        // You could refresh the dropdown lists via AJAX if needed
    });
    $('#tambahNilaiModal').on('show.bs.modal', function () {
        // same
    });
</script>
@endpush