<?php

namespace Database\Seeders;

use App\Models\CashBook;
use App\Models\KeuanganCategory;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CashBookSeeder extends Seeder
{
    public function run()
    {
        // Get categories for reference
        $pemasukanCategories = KeuanganCategory::where('tipe', 'pemasukan')->pluck('id')->toArray();
        $pengeluaranCategories = KeuanganCategory::where('tipe', 'pengeluaran')->pluck('id')->toArray();

        // Sample transactions for the last 3 months
        $transactions = [];

        // Generate sample data for last 90 days
        for ($i = 0; $i < 90; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            // Add 1-3 pemasukan per day (especially SPP payments)
            if ($i % 3 == 0) { // Every 3 days
                $transactions[] = [
                    'date' => $date,
                    'tipe' => 'pemasukan',
                    'category_id' => $pemasukanCategories[array_rand($pemasukanCategories)],
                    'debit' => rand(500000, 2000000),
                    'credit' => 0,
                    'note' => 'Pembayaran SPP bulan ' . Carbon::parse($date)->format('F Y'),
                ];
            }

            // Add daily pengeluaran
            if ($i % 2 == 0) { // Every other day
                $transactions[] = [
                    'date' => $date,
                    'tipe' => 'pengeluaran',
                    'category_id' => $pengeluaranCategories[array_rand($pengeluaranCategories)],
                    'debit' => 0,
                    'credit' => rand(50000, 500000),
                    'note' => 'Pengeluaran operasional harian',
                ];
            }
        }

        // Insert all transactions
        foreach ($transactions as $transaction) {
            CashBook::create($transaction);
        }
    }
}