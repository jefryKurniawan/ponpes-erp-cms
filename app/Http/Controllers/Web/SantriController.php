<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class SantriController extends Controller
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
        $query = Santri::latest();

        if ($keyword = $request->keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%")
                  ->orWhere('phone', 'like', "%{$keyword}%")
                  ->orWhere('birth_place', 'like', "%{$keyword}%")
                  ->orWhere('school_old', 'like', "%{$keyword}%")
                  ->orWhere('father_name', 'like', "%{$keyword}%")
                  ->orWhere('mother_name', 'like', "%{$keyword}%");
        }

        $data = $query->paginate(10);

        return view('santri.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin')) {
            return view('santri.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SantriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SantriRequest $request)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $validated = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('photo', 'public');
            $validated['photo'] = basename($path);
        }

        $santri = Santri::create($validated);

        LogActivity::addToLog('Tambah Data Santri: '.$santri->name);

        return redirect()->route('santri.index')
            ->with('success', 'Santri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show(Santri $santri)
    {
        // Eager load kelas and nilai with related data
        $santri->load(['kelas' => function($query) {
            $query->orderByPivot('tahun_ajaran', 'desc');
        }, 'nilai.mapel']);

        return view('santri.show', compact('santri'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit(Santri $santri)
    {
        if (Gate::allows('admin')) {
            return view('santri.edit', compact('santri'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SantriRequest  $request
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(SantriRequest $request, Santri $santri)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $validated = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($santri->photo && Storage::disk('public')->exists('photo/'.$santri->photo)) {
                Storage::disk('public')->delete('photo/'.$santri->photo);
            }

            $file = $request->file('photo');
            $path = $file->store('photo', 'public');
            $validated['photo'] = basename($path);
        }

        $santri->update($validated);

        LogActivity::addToLog('Update Data Santri: '.$santri->name);

        return redirect()->route('santri.index')
            ->with('success', 'Santri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Santri $santri)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        // Delete associated photo if exists
        if ($santri->photo && Storage::disk('public')->exists('photo/'.$santri->photo)) {
            Storage::disk('public')->delete('photo/'.$santri->photo);
        }

        LogActivity::addToLog('Hapus Data Santri: '.$santri->name);

        $santri->delete();

        return redirect()->route('santri.index')
            ->with('success', 'Santri berhasil dihapus.');
    }

    /**
     * Store a new kelas for the santri.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id  Santri UUID
     * @return \Illuminate\Http\Response
     */
    public function storeKelas(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $santri = Santri::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|uuid|exists:kelas,id',
            'tahun_ajaran' => 'required|string',
            'masuk_kelas' => 'nullable|date',
            'keluar_kelas' => 'nullable|date|after_or_equal:masuk_kelas',
        ]);

        // Attach kelas with pivot data
        $santri->kelas()->attach($request->kelas_id, [
            'tahun_ajaran' => $request->tahun_ajaran,
            'masuk_kelas' => $request->masuk_kelas,
            'keluar_kelas' => $request->keluar_kelas,
        ]);

        LogActivity::addToLog('Tambah Kelas Santri: '.$santri->name.' - Kelas ID: '.$request->kelas_id);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Store a new nilai for the santri.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id  Santri UUID
     * @return \Illuminate\Http\Response
     */
    public function storeNilai(Request $request, $id)
    {
        if (!Gate::allows('admin')) {
            abort(403);
        }

        $santri = Santri::findOrFail($id);

        $request->validate([
            'mapel_id' => 'required|uuid|exists:mapel,id',
            'nilai' => 'required|numeric|between:0,100',
            'semester' => 'required|in:Ganjil,Genap',
            'tahun_ajaran' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Check if nilai already exists for this santri, mapel, semester, tahun_ajaran
        $exists = Nilai::where('santri_id', $santri->id)
            ->where('mapel_id', $request->mapel_id)
            ->where('semester', $request->semester)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Nilai untuk mata pelajaran, semester, dan tahun ajaran ini sudah ada.')
                         ->withInput();
        }

        Nilai::create([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'santri_id' => $santri->id,
            'mapel_id' => $request->mapel_id,
            'nilai' => $request->nilai,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'keterangan' => $request->keterangan,
        ]);

        LogActivity::addToLog('Tambah Nilai Santri: '.$santri->name.' - Mapel ID: '.$request->mapel_id);

        return redirect()->back()->with('success', 'Nilai berhasil ditambahkan.');
    }
}