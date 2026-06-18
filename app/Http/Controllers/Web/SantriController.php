<?php

namespace App\Http\Controllers\Web;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Http\Requests\SantriRequest;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SantriController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        // Any authenticated user can view santri details
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
}