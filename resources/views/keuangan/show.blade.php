@extends('layouts.web')

@section('title', 'Detail Transaksi Keuangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Transaksi Keuangan</h1>
        <div class="btn-group">
            @can('admin' , 'bendahara')
            <a href="{{ route('keuangan.edit', $cashBook->id) }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <form action="{{ route('keuangan.destroy', $cashBook->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
            @endcan
            <a href="{{ route('keuangan.index') }}" class="btn btn-sm btn-outline-secondary">Kembali ke Daftar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Transaksi</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Tanggal Transaksi</dt>
                        <dd class="col-sm-9">{{ $cashBook->date }}</dd>

                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">
                            <span class="badge bg-{{ $cashBook->category->warna ?? 'secondary' }} fs-5">
                                {{$cashBook->category->nama}}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Keterangan</dt>
                        <dd class="col-sm-9">{{ $cashBook->note }}</dd>

                        <dt class="col-sm-3">Jenis Transaksi</dt>
                        <dd class="col-sm-9">
                            <span class="badge fs-5 {{ $cashBook->tipe == 'pemasukan' ? 'bg-success' : 'bg-danger' }}">
                                {{ $cashBook->tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}
                            </span>
                        </dd>

                        <dt class="col-sm-3">Jumlah</dt>
                        <dd class="col-sm-9">
                            <h3 class="mb-0 {{ $cashBook->tipe == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                                Rp {{ number_format($cashBook->tipe == 'pemasukan' ? $cashBook->debit : $cashBook->credit, 0, ',', '.') }}
                            </h3>
                            <p class="text-muted mb-0">
                                {{ $cashBook->tipe == 'pemasukan' ? '(Debit)' : '(Credit)' }}
                            </p>
                        </dd>

                        <dt class="col-sm-3">Catatan Sistem</dt>
                        <dd class="col-sm-9">
                            <small class="text-muted">
                                ID: {{$cashBook->id}}<br>
                                Dibuat: {{$cashBook->created_at->format('d-m-Y H:i')}}<br>
                                Diupdate: {{$cashBook->updated_at->format('d-m-Y H:i')}}
                            </small>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0>Detail Keuangan</h5>
                </div>
                <div class="card-body">
                    @php
                        $pemasukan = \App\Models\CashBook::where('tipe', 'pemasukan')->sum('debit');
                        $pengeluaran = \App\Models\CashBook::where('tipe', 'pengeluaran')->sum('credit');
                        $saldo = $pemasukan - $pengeluaran;
                    @endphp

                    <div class="mb-3">
                        <h6>Saldo Kas Sekarang</h6>
                        <div class="fs-4 fw-bold {{ $saldo >= 0 ? 'text-success' : 'text-danger' }}">
                            Rp {{ number_format($saldo, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6>Total Pemasukan</h6>
                        <div class="fs-5 text-success">
                            Rp {{ number_format($pemasukan, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6>Total Pengeluaran</h6>
                        <div class="fs-5 text-danger">
                            Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6>Transaksi Terkait</h6>
                    <div class="list-group">
                        @php
                            $related = \App\Models\CashBook::where('category_id', $cashBook->category_id)
                                ->where('id', '!=', $cashBook->id)
                                ->orderBy('date', 'DESC')
                                ->take(5)
                                ->get();
                        @endphp

                        @if($related->isEmpty())
                            <small class="text-muted">Belum ada transaksi terkait dalam kategori ini.</small>
                        @else
                            @foreach($related as $transaksi)
                                <div class="list-item d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <div>
                                        <small class="text-muted d-block">{{ $transaksi->date }}</small>
                                        <strong>{{ $transaksi->note }}</strong>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge {{ $transaksi->tipe == 'pemasukan' ? 'bg-success' : 'bg-danger' }} fs-6">
                                            {{ $transaksi->tipe == 'pemasukan' ? '+' : '-' }}
                                            Rp {{ number_format($transaksi->tipe == 'pemasukan' ? $transaksi->debit : $transaksi->credit, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .list-item {
        font-size: 0.9rem;
    }
</style>
@endpush