@extends('layouts.admin')

@section('title', 'Al-Hikmah Pesantren | Admin Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="font-headline-md text-headline-md text-on-surface">Sugeng Rawuh, {{ Auth::user()->santris->name ?? (Auth::user()->name ?? 'Admin') }}</h2>
    <p class="font-body-md text-on-surface-variant">Here is what's happening across Al-Hikmah today.</p>
</div>

<!-- Bento Grid: High-level Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    <div class="glass-card p-6 rounded-xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-6xl">groups</span>
        </div>
        <p class="text-on-surface-variant font-label-md mb-1">Total Santri</p>
        <h3 class="text-3xl font-headline-sm text-primary">{{ number_format($santri ?? 0) }}</h3>
        <p class="text-xs text-primary-container font-bold mt-2 flex items-center">
            <span class="material-symbols-outlined text-sm mr-1">trending_up</span>
            +12% this term
        </p>
    </div>
    <div class="glass-card p-6 rounded-xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-6xl">menu_book</span>
        </div>
        <p class="text-on-surface-variant font-label-md mb-1">Total Content</p>
        <h3 class="text-3xl font-headline-sm text-secondary">{{ $totalContent ?? 0 }}</h3>
        <p class="text-xs text-on-surface-variant mt-2 italic">{{ $totalContent > 0 ? 'Active & Published' : 'No content yet' }}</p>
    </div>
    <div class="glass-card p-6 rounded-xl relative overflow-hidden group border-l-4 border-primary">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-6xl">account_balance_wallet</span>
        </div>
        <p class="text-on-surface-variant font-label-md mb-1">Cash Balance</p>
        <h3 class="text-3xl font-headline-sm text-on-surface">Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</h3>
        <p class="text-xs text-on-surface-variant mt-2 italic">Updated 2m ago</p>
    </div>
    <div class="glass-card p-6 rounded-xl relative overflow-hidden group border-l-4 border-error">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-6xl">warning</span>
        </div>
        <p class="text-on-surface-variant font-label-md mb-1">Stock Alerts</p>
        <h3 class="text-3xl font-headline-sm text-error">{{ $stockAlerts ?? 0 }} Items</h3>
        @if(($stockAlerts ?? 0) > 0)
            <p class="text-xs text-error mt-2 font-bold underline cursor-pointer hover:text-error/80">Reorder Now</p>
        @else
            <p class="text-xs text-primary-container mt-2 font-bold">All stocked</p>
        @endif
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Column 1 & 2: Main Widgets -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Financial Trend Chart -->
        <div class="glass-card rounded-xl p-8 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h4 class="font-headline-sm text-headline-sm text-on-surface">Financial Trend</h4>
                <select class="bg-surface-container border-none text-xs rounded-full px-4 py-1 font-label-md focus:ring-primary/20">
                    <option>Last 6 Months</option>
                    <option>Year to Date</option>
                </select>
            </div>
            <div class="h-64">
                <canvas id="keuanganChart"></canvas>
            </div>
        </div>

        <!-- System Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="glass-card rounded-xl p-6 flex items-center space-x-6">
                <div class="w-16 h-16 rounded-full border-4 border-primary/20 flex items-center justify-center relative">
                    <span class="text-primary font-bold">98%</span>
                    <svg class="absolute inset-0 w-full h-full -rotate-90">
                        <circle class="text-primary" cx="32" cy="32" fill="none" r="28" stroke="currentColor" stroke-dasharray="176" stroke-dashoffset="3.5" stroke-width="4"></circle>
                    </svg>
                </div>
                <div>
                    <p class="font-label-md text-on-surface">Server Capacity</p>
                    <p class="text-xs text-on-surface-variant font-body-sm">Optimal Performance</p>
                </div>
            </div>
            <div class="glass-card rounded-xl p-6 flex items-center space-x-6">
                <div class="p-3 bg-secondary/10 rounded-full">
                    <span class="material-symbols-outlined text-secondary">cloud_done</span>
                </div>
                <div>
                    <p class="font-label-md text-on-surface">ERP Sync Status</p>
                    <p class="text-xs text-on-surface-variant font-body-sm">Last sync: 12 seconds ago</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Column 3: Activity Feed -->
    <div class="lg:col-span-1">
        <div class="glass-card rounded-xl p-6 h-full flex flex-col">
            <h4 class="font-headline-sm text-headline-sm text-on-surface mb-6">Recent Activity</h4>
            <div class="flex-1 space-y-6 overflow-y-auto pr-2 custom-scrollbar">
                @if(isset($recentActivities) && count($recentActivities) > 0)
                    @foreach($recentActivities as $activity)
                    <div class="flex items-start space-x-4">
                        <div class="mt-1 w-8 h-8 rounded-lg bg-{{ $activity['type'] === 'cms' ? 'secondary' : 'primary' }}/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-sm text-{{ $activity['type'] === 'cms' ? 'secondary' : 'primary' }}">{{ $activity['icon'] }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-body-md"><span class="font-bold">System</span> {{ strtolower($activity['title']) }}<span class="font-bold"> {{ $activity['description'] ?? '' }}</span></p>
                            <p class="text-[10px] text-outline font-bold uppercase mt-1">{{ strtoupper($activity['type']) }} • {{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="flex items-start space-x-4">
                        <div class="mt-1 w-8 h-8 rounded-lg bg-secondary/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-sm text-secondary">edit_note</span>
                        </div>
                        <div>
                            <p class="text-sm font-body-md"><span class="font-bold">System</span> published a new article</p>
                            <p class="text-[10px] text-outline font-bold uppercase mt-1">CMS • 24m ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="mt-1 w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-sm text-primary">person_add</span>
                        </div>
                        <div>
                            <p class="text-sm font-body-md">New student registration received</p>
                            <p class="text-[10px] text-outline font-bold uppercase mt-1">ERP • 1h ago</p>
                        </div>
                    </div>
                @endif
            </div>
            <button class="w-full mt-8 py-3 rounded-lg border-2 border-primary/20 text-primary font-label-md hover:bg-primary hover:text-white transition-all" onclick="window.location.href='{{ route('logs.index') }}'">
                View Detailed Audit Log
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('keuanganChart').getContext('2d');

        // Fetch data from API
        fetch('{{ route('keuangan.dashboardStats') }}')
            .then(response => response.json())
            .then(data => {
                const labels = data.monthly_trend && data.monthly_trend.length > 0
                    ? data.monthly_trend.map(item => item.bulan)
                    : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
                const pemasukan = data.monthly_trend && data.monthly_trend.length > 0
                    ? data.monthly_trend.map(item => item.pemasukan)
                    : [0, 0, 0, 0, 0, 0];
                const pengeluaran = data.monthly_trend && data.monthly_trend.length > 0
                    ? data.monthly_trend.map(item => item.pengeluaran)
                    : [0, 0, 0, 0, 0, 0];
                const saldo = data.monthly_trend && data.monthly_trend.length > 0
                    ? data.monthly_trend.map(item => item.saldo)
                    : [0, 0, 0, 0, 0, 0];

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Pemasukan',
                                data: pemasukan,
                                borderColor: 'rgba(0, 105, 72, 0.8)',
                                backgroundColor: 'rgba(0, 105, 72, 0.2)',
                                tension: 0.3,
                                fill: false,
                            },
                            {
                                label: 'Pengeluaran',
                                data: pengeluaran,
                                borderColor: 'rgba(147, 75, 25, 0.8)',
                                backgroundColor: 'rgba(147, 75, 25, 0.2)',
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
                                    callback: function(value) {
                                        return 'Rp ' + Number(value).toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => {
                console.error('Failed to fetch keuangan stats:', err);
                // Fallback data jika API gagal
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                        datasets: [
                            {
                                label: 'Pemasukan',
                                data: [0, 0, 0, 0, 0, 0],
                                borderColor: 'rgba(0, 105, 72, 0.8)',
                                backgroundColor: 'rgba(0, 105, 72, 0.2)',
                                tension: 0.3,
                                fill: false,
                            },
                            {
                                label: 'Pengeluaran',
                                data: [0, 0, 0, 0, 0, 0],
                                borderColor: 'rgba(147, 75, 25, 0.8)',
                                backgroundColor: 'rgba(147, 75, 25, 0.2)',
                                tension: 0.3,
                                fill: false,
                            },
                            {
                                label: 'Saldo',
                                data: [0, 0, 0, 0, 0, 0],
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
                            legend: { position: 'top' },
                            tooltip: { mode: 'index', intersect: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + Number(value).toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            });
    });
</script>
@endsection