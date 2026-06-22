<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!Gate::allows('admin') && !Gate::allows('bendahara')) {
            abort(403);
        }

        $tanggal = $request->input('tanggal', date('Y-m-d'));
        $absensis = Absensi::with('santri')
            ->whereDate('tanggal', $tanggal)
            ->orderByRaw("santri_id, tanggal")
            ->get()
            ->keyBy('santri_id');

        $santris = Santri::whereDoesntHave('absensi', function ($q) use ($tanggal) {
            $q->whereDate('tanggal', $tanggal);
        })->orderBy('name')->get();

        return view('admin.absensi.index', compact('absensis', 'santris', 'tanggal'));
    }

    public function store(Request $request)
    {
        if (!Gate::allows('admin') && !Gate::allows('bendahara')) {
            abort(403);
        }

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'santri_id' => 'required|uuid|exists:santris,id',
            'pagi' => 'required|in:hadir,izin,sakit,alfa',
            'sore' => 'required|in:hadir,izin,sakit,alfa',
            'keterangan' => 'nullable|string|max:500',
        ]);

        Absensi::updateOrCreate(
            ['santri_id' => $validated['santri_id'], 'tanggal' => $validated['tanggal']],
            $validated
        );

        return redirect()->route('absensi.index', ['tanggal' => $validated['tanggal']])
            ->with('success', 'Absensi berhasil disimpan.');
    }

    public function bulkUpdate(Request $request)
    {
        if (!Gate::allows('admin') && !Gate::allows('bendahara')) {
            abort(403);
        }

        $validated = $request->validate([
            'tanggal' => 'required|date',
            'absence' => 'required|array',
            'absence.*.santri_id' => 'required|uuid|exists:santris,id',
            'absence.*.pagi' => 'required|in:hadir,izin,sakit,alfa',
            'absence.*.sore' => 'required|in:hadir,izin,sakit,alfa',
            'absence.*.keterangan' => 'nullable|string|max:500',
        ]);

        foreach ($validated['absence'] as $data) {
            Absensi::updateOrCreate(
                ['santri_id' => $data['santri_id'], 'tanggal' => $validated['tanggal']],
                [
                    'pagi' => $data['pagi'],
                    'sore' => $data['sore'],
                    'keterangan' => $data['keterangan'] ?? null,
                ]
            );
        }

        return redirect()->route('absensi.index', ['tanggal' => $validated['tanggal']])
            ->with('success', 'Absensi berhasil disimpan.');
    }
}