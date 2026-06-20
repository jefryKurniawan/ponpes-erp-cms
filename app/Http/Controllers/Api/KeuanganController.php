<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CashBook;
use App\Models\KeuanganCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $query = CashBook::with(['category']);

        // Filter by date range if provided
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Filter by type
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $data = $query->orderBy('date', 'ASC')->get();

        return response()->json($data);
    }

    /**
     * Get dashboard stats for keuangan module.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardStats(Request $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $today = Carbon::today();
        $sixMonthsAgo = $today->copy()->subMonths(6);

        // Current balance
        $pemasukan = CashBook::where('tipe', 'pemasukan')->sum('debit');
        $pengeluaran = CashBook::where('tipe', 'pengeluaran')->sum('credit');
        $saldo = $pemasukan - $pengeluaran;

        // Monthly trend for last 6 months
        $monthlyData = CashBook::selectRaw(
            'SUM(CASE WHEN tipe = "pemasukan" THEN debit ELSE 0 END) as pemasukan,
            SUM(CASE WHEN tipe = "pengeluaran" THEN credit ELSE 0 END) as pengeluaran,
            DATE_FORMAT(date, "%Y-%m") as month'
        )
            ->whereBetween('date', [$sixMonthsAgo, $today])
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                return [
                    'bulan' => Carbon::parse($item->month)->format('M Y'),
                    'pemasukan' => (float) $item->pemasukan,
                    'pengeluaran' => (float) $item->pengeluaran,
                    'saldo' => (float) ($item->pemasukan - $item->pengeluaran)
                ];
            });

        // Categories breakdown
        $categories = KeuanganCategory::withCount([
            'cashBooks as pemasukan_count' => function($query) {
                $query->where('tipe', 'pemasukan');
            },
            'cashBooks as pengeluaran_count' => function($query) {
                $query->where('tipe', 'pengeluaran');
            }
        ])
        ->get()
        ->map(function($category) {
            return [
                'id' => $category->id,
                'nama' => $category->nama,
                'tipe' => $category->tipe,
                'icon' => $category->icon,
                'warna' => $category->warna,
                'pemasukan_count' => (int) $category->pemasukan_count,
                'pengeluaran_count' => (int) $category->pengeluaran_count
            ];
        });

        return response()->json([
            'saldo' => (float) $saldo,
            'pemasukan_total' => (float) $pemasukan,
            'pengeluaran_total' => (float) $pengeluaran,
            'monthly_trend' => $monthlyData,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KeuanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|uuid|exists:keuangan_categories,id',
            'note' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'tipe' => 'required|in:pemasukan,pengeluaran',
        ]);

        // Custom validation for jumlah based on tipe
        if ($validated['tipe'] === 'pemasukan' && $validated['jumlah'] < 0) {
            // Allow negative only if note indicates pengembalian (case-insensitive)
            if (empty($validated['note']) || !stripos($validated['note'], 'pengembalian')) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => ['jumlah' => ['Jumlah pemasukan tidak boleh negatif kecuali untuk pengembalian']]
                ], 422);
            }
        }

        // Determine whether to store as debit or credit based on tipe
        $transactionData = [
            'date' => $validated['date'],
            'category_id' => $validated['category_id'],
            'note' => $validated['note'],
            'tipe' => $validated['tipe'],
        ];

        if ($validated['tipe'] === 'pemasukan') {
            $transactionData['debit'] = abs($validated['jumlah']); // Ensure positive
            $transactionData['credit'] = 0;
        } else { // pengeluaran
            $transactionData['debit'] = 0;
            $transactionData['credit'] = abs($validated['jumlah']); // Ensure positive
        }

        $cashBook = CashBook::create($transactionData);

        return response()->json([
            'message' => 'Transaksi keuangan berhasil ditambahkan.',
            'data' => $cashBook->load('category')
        ], 201);
    }
}