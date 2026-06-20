@extends('layouts.web')

@section('title', 'Manajemen Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Keuangan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @canany('admin','bendahara')
            <a href="{{ route('keuangan.create') }}" class="btn btn-sm btn-outline-secondary me-2">Tambah Transaksi</a>
            <a href="{{ route('keuangan.export', ['type' => 'pdf']) }}" class="btn btn-sm btn-outline-success me-1">
                <i class="bi bi-file-earmark-pdf"></i> PDF
            </a>
            <a href="{{ route('keuangan.export', ['type' => 'excel']) }}" class="btn btn-sm btn-outline-info">
                <i class="bi bi-file-earmark-excel"></i> Excel
            </a>
            @endcanany
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-light text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <p class="card-text display-4 text-success">{{ number_format($pemasukan, 0, ',', '.') }}</p>
                    <p class="card-text text-muted small">Rp</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <p class="card-text display-4 text-danger">{{ number_format($pengeluaran, 0, ',', '.') }}</p>
                    <p class="card-text text-muted small">Rp</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Saldo Kas</h5>
                    <p class="card-text display-4 {{ $saldo >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($saldo, 0, ',', '.') }}</p>
                    <p class="card-text text-muted small">Rp</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light text-dark h-100">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Transaksi</h5>
                    <p class="card-text display-4 text-primary">{{ $data->total() }}</p>
                    <p class="card-text text-muted small">transaksi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-4">
            <form method="GET" action="{{ route('keuangan.index') }}" class="row g-3">
                <div class="col-md-12">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $filter['date'] ?? '' }}">
                </div>
                <div class="col-md-12">
                    <label for="tipe" class="form-label">Jenis</label>
                    <select class="form-select" id="tipe" name="tipe">
                        <option value="">Semua Jenis</option>
                        <option value="pemasukan" {{ $filter['tipe'] == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ $filter['tipe'] == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $filter['category_id'] == $category->id ? 'selected' : '' }}>
                                {{ $category->nama }} ({{ $category->tipe }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('keuangan.index') }}" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-end">Jumlah</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($data->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada transaksi keuangan.</td>
                    </tr>
                @else
                    @foreach($data as $transaction)
                        <tr>
                            <td>{{ $transaction->date }}</td>
                            <td>
                                <span class="badge bg-{{ $transaction->category->warna ?? 'secondary' }} ">
                                    {{$transaction->category->nama}}
                                </span>
                            </td>
                            <td>{{$transaction->note}}</td>
                            <td class="text-center">
                                <span class="badge {{ $transaction->tipe == 'pemasukan' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $transaction->tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}
                                </span>
                            </td>
                            <td class="text-end">
                                {{ number_format($transaction->tipe == 'pemasukan' ? $transaction->debit : $transaction->credit, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('keuangan.show', $transaction->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @can('admin' , 'bendahara')
                                    <a href="{{ route('keuangan.edit', $transaction->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('keuangan.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{$data->links()}}
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-refresh dashboard stats every 30 seconds
    setInterval(function() {
        // You can implement AJAX refresh here if needed
    }, 30000);
</script>
@endpush