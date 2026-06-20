@extends('layouts.home')
@section('title_page','Dashboard')
@section('content')

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Santri</h4>
                </div>
                <div class="card-body">
                    {{ $santri }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Surat Masuk</h4>
                </div>
                <div class="card-body">
                    {{ $in_mail }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Surat Keluar</h4>
                </div>
                <div class="card-body">
                    {{ $out_mail }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengguna</h4>
                </div>
                <div class="card-body">
                    {{ $users }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-2">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pemasukan Kas</h4>
                </div>
                <div class="card-body">
                    <h5>Rp. {{ number_format($pemasukan, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-2">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengeluaran Kas</h4>
                </div>
                <div class="card-body">
                    <h5>Rp. {{ number_format($pengeluaran, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-2">
            <div class="card-icon bg-primary-2">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Saldo Kas</h4>
                    @canany('admin','bendahara')
                    <a href="{{ route('keuangan.create') }}" class="btn btn-sm btn-outline-primary">Tambah Transaksi</a>
                    @endcanany
                </div>
                <div class="card-body">
                    <h5>Rp. {{ number_format($saldo, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart Card -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Tren Keuangan 6 Bulan Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="keuanganChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('keuanganChart').getContext('2d');
        // Fetch data from API
        fetch('{{ route('keuangan.dashboardStats') }}')
            .then(response => response.json())
            .then(data => {
                const labels = data.monthly_trend.map(item => item.bulan);
                const pemasukan = data.monthly_trend.map(item => item.pemasukan);
                const pengeluaran = data.monthly_trend.map(item => item.pengeluaran);
                const saldo = data.monthly_trend.map(item => item.saldo);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Pemasukan',
                                data: pemasukan,
                                borderColor: 'rgba(40, 167, 69, 0.8)',
                                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                                tension: 0.3,
                                fill: false,
                            },
                            {
                                label: 'Pengeluaran',
                                data: pengeluaran,
                                borderColor: 'rgba(220, 53, 69, 0.8)',
                                backgroundColor: 'rgba(220, 53, 69, 0.2)',
                                tension: 0.3,
                                fill: false,
                            },
                            {
                                label: 'Saldo',
                                data: saldo,
                                borderColor: 'rgba(0, 123, 255, 0.8)',
                                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                                tension: 0.3,
                                fill: false,
                                borderDash: [5, 5],
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                ticks: {
                                    // Format as currency
                                    callback: function(value) {
                                        return 'Rp. ' + Number(value).toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => {
                console.error('Failed to fetch keuangan stats:', err);
                // Optionally show a message to user
            });
    });
</script>
@endpush
