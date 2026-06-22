@extends('layouts.admin')

@section('title', 'Al-Hikmah Pesantren | Admin Dashboard')

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
        <div class="mb-8">
            <h2 class="font-headline-md text-headline-md text-on-surface">Sugeng Rawuh, {{ Auth::user()->name ?? 'Admin' }}</h2>
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
                <p class="text-xs text-primary-container font-bold mt-2">
                    <a href="{{ route('santri.index') }}" class="hover:underline">Lihat semua →</a>
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
                <p class="text-xs text-on-surface-variant mt-2">
                    <a href="{{ route('keuangan.index') }}" class="hover:underline">Lihat keuangan →</a>
                </p>
            </div>
            <div class="glass-card p-6 rounded-xl relative overflow-hidden group border-l-4 border-error">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-6xl">warning</span>
                </div>
                <p class="text-on-surface-variant font-label-md mb-1">Stock Alerts</p>
                <h3 class="text-3xl font-headline-sm text-error">{{ $stockAlerts ?? 0 }} Items</h3>
                @if(($stockAlerts ?? 0) > 0)
                    <p class="text-xs text-error mt-2 font-bold">
                        <a href="{{ route('inventaris.index') }}" class="hover:underline">Cek inventaris →</a>
                    </p>
                @else
                    <p class="text-xs text-primary-container mt-2 font-bold">Stok aman</p>
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
                    </div>
                    <div class="h-64 relative">
                        <div id="chart-loading" class="absolute inset-0 flex items-center justify-center bg-surface/50 rounded-lg">
                            <div class="text-on-surface-variant text-sm font-label-md animate-pulse">Loading chart...</div>
                        </div>
                        <canvas id="keuanganChart"></canvas>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <a href="{{ route('absensi.index') }}" class="glass-card rounded-xl p-4 flex items-center gap-4 hover:bg-primary/5 hover:border-primary/30 transition-all cursor-pointer">
                        <div class="p-2 rounded-lg bg-green-100">
                            <span class="material-symbols-outlined text-green-700">assignment_turned_in</span>
                        </div>
                        <div>
                            <p class="font-label-md text-on-surface">Absensi</p>
                            <p class="text-xs text-on-surface-variant">Input kehadiran hari ini</p>
                        </div>
                    </a>
                    <a href="{{ route('syahriah.create') }}" class="glass-card rounded-xl p-4 flex items-center gap-4 hover:bg-primary/5 hover:border-primary/30 transition-all cursor-pointer">
                        <div class="p-2 rounded-lg bg-blue-100">
                            <span class="material-symbols-outlined text-blue-700">payments</span>
                        </div>
                        <div>
                            <p class="font-label-md text-on-surface">Syahriah</p>
                            <p class="text-xs text-on-surface-variant">Catat pembayaran SPP</p>
                        </div>
                    </a>
                    <a href="{{ route('registration.create') }}" class="glass-card rounded-xl p-4 flex items-center gap-4 hover:bg-primary/5 hover:border-primary/30 transition-all cursor-pointer">
                        <div class="p-2 rounded-lg bg-purple-100">
                            <span class="material-symbols-outlined text-purple-700">how_to_reg</span>
                        </div>
                        <div>
                            <p class="font-label-md text-on-surface">Pendaftaran</p>
                            <p class="text-xs text-on-surface-variant">Santri baru</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="glass-card rounded-xl p-4 flex items-center gap-4 hover:bg-primary/5 hover:border-primary/30 transition-all cursor-pointer">
                        <div class="p-2 rounded-lg bg-gray-100">
                            <span class="material-symbols-outlined text-gray-700">settings</span>
                        </div>
                        <div>
                            <p class="font-label-md text-on-surface">Pengaturan</p>
                            <p class="text-xs text-on-surface-variant">Branding & tema</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Column 3: Activity Feed -->
            <div class="lg:col-span-1">
                <div class="glass-card rounded-xl p-6 h-full flex flex-col">
                    <h4 class="font-headline-sm text-headline-sm text-on-surface mb-6">Recent Activity</h4>
                    <div class="flex-1 space-y-6 overflow-y-auto pr-2 custom-scrollbar">
                        @if(isset($recentActivities) && count($recentActivities) > 0)
                            @foreach($recentActivities as $activity)
                            @php $isCms = $activity['type'] === 'cms'; @endphp
                            <div class="flex items-start space-x-4">
                                <div class="mt-1 w-8 h-8 rounded-lg @if($isCms) bg-secondary/10 @else bg-primary/10 @endif flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-sm @if($isCms) text-secondary @else text-primary @endif">{{ $activity['icon'] }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-body-md"><span class="font-bold">System</span> {{ strtolower($activity['title']) }}<span class="font-bold"> {{ $activity['description'] ?? '' }}</span></p>
                                    <p class="text-[10px] text-outline font-bold uppercase mt-1">{{ strtoupper($activity['type']) }} • {{ $activity['time'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-8 text-on-surface-variant">
                                <span class="material-symbols-outlined text-surface-dim scale-[2]" style="font-size: 40px;">inbox</span>
                                <p class="text-sm mt-4">Belum ada aktivitas terbaru</p>
                            </div>
                        @endif
                    </div>
                    <button class="w-full mt-8 py-3 rounded-lg border-2 border-primary/20 text-primary font-label-md hover:bg-primary hover:text-white transition-all" onclick="window.location.href='{{ route('logs.index') }}'">
                        View Detailed Audit Log
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    const CHART_COLORS = {
        pemasukan: 'rgba(0, 105, 72, 0.8)',
        pengeluaran: 'rgba(147, 75, 25, 0.8)',
        saldo: 'rgba(0, 123, 255, 0.8)',
    };

    function makeDataset(label, data, color, extra) {
        return { label, data, borderColor: color, backgroundColor: color.replace('0.8', '0.2'), tension: 0.3, fill: false, ...extra };
    }

    function renderChart(ctx, labels, data1, data2, data3) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    makeDataset('Pemasukan', data1, CHART_COLORS.pemasukan),
                    makeDataset('Pengeluaran', data2, CHART_COLORS.pengeluaran),
                    makeDataset('Saldo', data3, CHART_COLORS.saldo, { borderDash: [5, 5] }),
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: { beginAtZero: false, ticks: { callback: v => 'Rp ' + Number(v).toLocaleString('id-ID') } }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('keuanganChart').getContext('2d');
        const loading = document.getElementById('chart-loading');

        fetch('{{ route('keuangan.dashboardStats') }}')
            .then(r => r.json())
            .then(data => {
                if (loading) loading.remove();
                const trend = data.monthly_trend || [];
                renderChart(ctx,
                    trend.length ? trend.map(i => i.bulan) : ['Jan','Feb','Mar','Apr','May','Jun'],
                    trend.length ? trend.map(i => i.pemasukan) : [0,0,0,0,0,0],
                    trend.length ? trend.map(i => i.pengeluaran) : [0,0,0,0,0,0],
                    trend.length ? trend.map(i => i.saldo) : [0,0,0,0,0,0]
                );
            })
            .catch(err => {
                console.error('Failed to fetch keuangan stats:', err);
                if (loading) { loading.textContent = 'Gagal memuat data'; loading.classList.remove('animate-pulse'); }
            });
    });
</script>
@endsection