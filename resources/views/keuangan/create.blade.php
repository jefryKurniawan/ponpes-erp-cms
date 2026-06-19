@extends('layouts.web')

@section('title', 'Tambah Transaksi Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Transaksi Keuangan</h1>
        <a href="{{ route('keuangan.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('keuangan.store') }}" method="POST" class="card p-4">
                @csrf

                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') ?? today() }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories->groupBy('tipe') as $tipe => $kategoris)
                            <optgroup label="{{ $tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}">
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('category_id') == $kategori->id ? 'selected' : '' }}>
                                        {{$kategori->nama}}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Keterangan</label>
                    <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" maxlength="255" value="{{ old('note') }}" required>
                    @error('note')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" step="0.01" min="0" value="{{ old('jumlah') }}" required>
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            Untuk pemasukan, masukkan nilai positif. Untuk pengeluaran, masukkan nilai positif.
                            <br>Sistem otomatis akan menentukan apakah itu debit atau credit berdasarkan jenis transaksi.
                        </small>
                    </div>
                    <div class="col-md-6">
                        <label for="tipe" class="form-label">Jenis Transaksi</label>
                        <select class="form-select @error('tipe') is-invalid @enderror" id="tipe" name="tipe" required>
                            <option value="">Pilih Jenis</option>
                            <option value="pemasukan" {{ old('tipe') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ old('tipe') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                        @error('tipe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Simpan Transaksi</button>
                    <a href="{{ route('keuangan.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Petunjuk Penggunaan</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle me-2 text-success"></i> Pilih tanggal transaksi</li>
                        <li><i class="bi bi-check-circle me-2 text-success"></i> Pilih kategori yang sesuai</li>
                        <li><i class="bi bi-check-circle me-2 text-success"></i> Keterangkan transaksi</li>
                        <li><i class="bi bi-check-circle me-2 text-success"></i> Masukkan jumlah transaksi</li>
                        <li><i class="bi bi-check-circle me-2 text-success"></i> Pilih jenis transaksi (pemasukan/pengeluaran)</li>
                        <li><i class="bi bi-check-circle me-2 text-success"></i> Klik "Simpan Transaksi" untuk menyimpan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-set today's date
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
    });
</script>
@endpush