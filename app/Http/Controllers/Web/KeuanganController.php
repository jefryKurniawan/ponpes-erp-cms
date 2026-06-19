<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\KeuanganRequest;
use App\Models\CashBook;
use App\Models\KeuanganCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class KeuanganController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CashBook::with(['category'])
            ->orderBy('date', 'DESC')
            ->orderBy('created_at', 'DESC');

        $filter = $request->only(['date', 'tipe', 'category_id']);

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // Filter by type (pemasukan/pengeluaran)
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $data = $query->paginate(10);

        // Get summary stats
        $pemasukan = CashBook::where('tipe', 'pemasukan')->sum('debit');
        $pengeluaran = CashBook::where('tipe', 'pengeluaran')->sum('credit');
        $saldo = $pemasukan - $pengeluaran;

        $categories = KeuanganCategory::all();

        return view('keuangan.index', compact(
            'data',
            'pemasukan',
            'pengeluaran',
            'saldo',
            'categories',
            'filter'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            $categories = KeuanganCategory::all()->groupBy('tipe');
            return view('keuangan.create', compact('categories'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KeuanganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeuanganRequest $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $validated = $request->validated();

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

        CashBook::create($transactionData);

        LogActivity::addToLog('Transaksi Keuangan: '.$validated['note']);

        return redirect()->route('keuangan.index')
            ->with('success', 'Transaksi keuangan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashBook  $cashBook
     * @return \Illuminate\Http\Response
     */
    public function show(CashBook $cashBook)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('keuangan.show', compact('cashBook'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashBook  $cashBook
     * @return \Illuminate\Http\Response
     */
    public function edit(CashBook $cashBook)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            $categories = KeuanganCategory::all()->groupBy('tipe');
            return view('keuangan.edit', compact('cashBook', 'categories'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KeuanganRequest  $request
     * @param  \App\Models\CashBook  $cashBook
     * @return \Illuminate\Http\Response
     */
    public function update(KeuanganRequest $request, CashBook $cashBook)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $validated = $request->validated();

        // Determine whether to store as debit or credit based on tipe
        $transactionData = [
            'date' => $validated['date'],
            'category_id' => $validated['category_id'],
            'note' => $validated['note'],
            'tipe' => $validated['tipe'],
        ];

        if ($validated['tipe'] === 'pemasukan') {
            $transactionData['debit'] = abs($validated['jumlah']);
            $transactionData['credit'] = 0;
        } else { // pengeluaran
            $transactionData['debit'] = 0;
            $transactionData['credit'] = abs($validated['jumlah']);
        }

        $cashBook->update($transactionData);

        LogActivity::addToLog('Update Transaksi Keuangan: '.$cashBook->note);

        return redirect()->route('keuangan.index')
            ->with('success', 'Transaksi keuangan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashBook  $cashBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashBook $cashBook)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        LogActivity::addToLog('Hapus Transaksi Keuangan: '.$cashBook->note);

        $cashBook->delete();

        return redirect()->route('keuangan.index')
            ->with('success', 'Transaksi keuangan berhasil dihapus.');
    }

    /**
     * Export transactions to PDF or Excel
     *
     * @param  string  $type  Export type (pdf or excel)
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(string $type, Request $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        // Apply same filters as index method
        $query = CashBook::with(['category'])
            ->orderBy('date', 'DESC')
            ->orderBy('created_at', 'DESC');

        $filter = $request->only(['date', 'tipe', 'category_id']);

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // Filter by type (pemasukan/pengeluaran)
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $transactions = $query->get();

        if ($type === 'pdf') {
            // Export to PDF using DomPDF
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadView('keuangan.export.pdf', compact('transactions', 'filter'));
            return $pdf->stream('laporan-keuangan-' . now()->format('Y-m-d-H-i-s') . '.pdf');
        } elseif ($type === 'excel') {
            // Export to Excel (CSV format)
            $filename = 'laporan-keuangan-' . now()->format('Y-m-d-H-i-s') . '.csv';
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('Tanggal', 'Kategori', 'Keterangan', 'Jenis', 'Jumlah (Rp)');

            $callback = function() use ($transactions) {
                $file = fopen('php://output', 'w');
                fputcsv($file, array('Tanggal', 'Kategori', 'Keterangan', 'Jenis', 'Jumlah (Rp)'));

                foreach ($transactions as $transaction) {
                    $row['Tanggal'] = $transaction->date;
                    $row['Kategori'] = $transaction->category->nama ?? '-';
                    $row['Keterangan'] = $transaction->note;
                    $row['Jenis'] = $transaction->tipe == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran';
                    $row['Jumlah (Rp)'] = number_format($transaction->tipe == 'pemasukan' ? $transaction->debit : $transaction->credit, 0, ',', '.');
                    fputcsv($file, array($row['Tanggal'], $row['Kategori'], $row['Keterangan'], $row['Jenis'], $row['Jumlah (Rp)']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        // Default fallback
        return redirect()->route('keuangan.index')
            ->with('error', 'Jenis ekspor tidak valid.');
    }
}