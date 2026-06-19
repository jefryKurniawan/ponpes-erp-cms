@extends('layouts.web')

@section('title', 'Edit Transaksi Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Transaksi Keuangan</h1>
        <a href="{{ route('keuangan.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('keuangan.update', $cashBook->id) }}" method="POST" class="card p-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $cashBook->date) }}" required>
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
                                    <option value="{{ $kategori->id }}" {{ old('category_id', $cashBook->category_id) == $kategori->id ? 'selected' : '' }}>
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
                    <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" maxlength="255" value="{{ old('note', $cashBook->note) }}" required>
                    @error('note')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="jumlah" class="form-label">Jumlah (Rp)</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" step="0.01" min="0" value="{{ old('jumlah', $cashBook->tipe == 'pemasukan' ? $cashBook->debit : $cashBook->credit) }}" required>
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
                            <option value="pemasukan" {{ old('tipe', $cashBook->tipe) == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                            <option value="pengeluaran" {{ old('tipe', $cashBook->tipe) == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                        @error('tipe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Update Transaksi</button>
                    <a href="{{ route('keuangan.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">Detail Transaksi</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tanggal:</strong> {{ $cashBook->date }}</p>
                    <p><strong>Kategori:</strong> <span class="badge bg-{{ $cashBook->category->warna ?? 'secondary' }}">{{ $cashBook->category->nama }}</span></p>
                    <p><strong>Keterangan:</strong> {{ $cashBook->note }}</p>
                    <p><strong>Jenis:</strong> <span class="badge {{ $cashBook->tipe == 'pemasukan' ? 'bg-success' : 'bg-danger' }}">{{ $cashBook->tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}</span></p>
                    <p><strong>Jumlah:</strong> Rp {{ number_format($cashBook->tipe == 'pemasukan' ? $cashBook->debit : $cashBook->credit, 0, ',', '.') }}</p>
                    <hr>
                    <small class="text-muted">
                        <strong>Catatan:</strong> Sistem akan otomatis mengkonversi jumlah yang Anda masukkan ke dalam format debit atau credit berdasarkan jenis transaksi yang dipilih.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-set date field
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');
        if (dateInput.value) {
            // Already populated from server
        }
    });
</script>
@endpush