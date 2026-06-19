<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class GaleriController extends Controller
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
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            $query = Gallery::query();

            // Filter by active status
            if ($request->filled('is_active')) {
                $query->where('is_active', $request->is_active == '1');
            }

            $galleries = $query->orderBy('created_at', 'desc')
                                ->paginate(10);

            return view('admin.galeri.index', compact('galleries', $request->only(['is_active'])));
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.galeri.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $validated = $request->validated();

        $gallery = Gallery::create($validated);

        return redirect()->route('admin.galeri.index')
                        ->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.galeri.show', compact('gallery'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.galeri.edit', compact('gallery'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $gallery->update($request->validated());

        return redirect()->route('admin.galeri.index')
                        ->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $gallery->delete();

        return redirect()->route('admin.galeri.index')
                        ->with('success', 'Galeri berhasil dihapus.');
    }
}