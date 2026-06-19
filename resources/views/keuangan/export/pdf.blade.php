<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .amount-in { color: #28a745; font-weight: bold; }
        .amount-out { color: #dc3545; font-weight: bold; }
        .footer { margin-top: 30px; text-align: center; font-size: 0.9em; color: #666; }
        .header-info { margin-bottom: 20px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #007bff; }
    </style>
</head>
<body>
    <div class="header-info">
        <h1>Laporan Keuangan Pesantren</h1>
        <p><strong>Periode:</strong>
            @if($filter['date'])
                {{ $filter['date'] }}
            @else
                Semua tanggal
            @endif
        </p>
        <p><strong>Jenis:</strong>
            @if($filter['tipe'])
                {{ $filter['tipe'] == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}
            @else
                Semua jenis
            @endif
        </p>
        <p><strong>Kategori:</strong>
            @if($filter['category_id'])
                @php
                    $category = \App\Models\KeuanganCategory::find($filter['category_id']);
                    echo $category ? $category->nama : '-';
                @endphp
            @else
                Semua kategori
            @endif
        </p>
        <p><strong>Dicetak tanggal:</strong> {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th class="text-end">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @if($transactions->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Belum ada transaksi keuangan.</td>
                </tr>
            @else
                @php
                    $totalPemasukan = 0;
                    $totalPengeluaran = 0;
                @endphp
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->category->nama ?? '-' }}</td>
                        <td>{{ $transaction->note }}</td>
                        <td>
                            <span class="{{ $transaction->tipe == 'pemasukan' ? 'amount-in' : 'amount-out' }}">
                                {{ $transaction->tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <span class="{{ $transaction->tipe == 'pemasukan' ? 'amount-in' : 'amount-out' }}">
                                {{ number_format($transaction->tipe == 'pemasukan' ? $transaction->debit : $transaction->credit, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    @php
                        if($transaction->tipe == 'pemasukan') {
                            $totalPemasukan += $transaction->debit;
                        } else {
                            $totalPengeluaran += $transaction->credit;
                        }
                    @endphp
                @endforeach

                <!-- Total Row -->
                <tr style="background-color: #e9ecef; font-weight: bold;">
                    <td colspan="3">Total</td>
                    <td></td>
                    <td class="text-end">
                        Rp {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Sistem Manajemen Pesantren ERP-CMS</p>
        <p>Halaman {{ $pdf->getPageNumber() }} dari {{ $pdf->getPageCount() }}</p>
    </div>
</body>
</html>