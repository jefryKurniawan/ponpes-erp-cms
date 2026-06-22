<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CmsSettingsController extends Controller
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
            $settings = Setting::orderBy('type')
                                ->get()
                                ->groupBy('type')
                                ->filter(function ($group, $key) {
                                    return is_string($key)
                                        && $group instanceof \Illuminate\Support\Collection
                                        && !$group->isEmpty()
                                        && $group->first() instanceof \App\Models\Setting;
                                });

            return view('admin.settings.index', compact('settings'));
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
            return view('admin.settings.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SettingRequest  $request
     * =  \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        Setting::create($request->validated());

        return redirect()->route('admin.settings.index')
                        ->with('success', 'Pengaturan CMS berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * =  \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.settings.show', compact('setting'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * =  \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        if (Gate::allows('admin') || Gate::allows('bendahara')) {
            return view('admin.settings.edit', compact('setting'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingRequest  $request
     * =  \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $setting->update($request->validated());

        return redirect()->route('admin.settings.index')
                        ->with('success', 'Pengaturan CMS berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * =  \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $setting->delete();

        return redirect()->route('admin.settings.index')
                        ->with('success', 'Pengaturan CMS berhasil dihapus.');
    }

    /**
     * Upload favicon.
     */
    public function uploadFavicon(Request $request)
    {
        if (!(Gate::allows('admin') || Gate::allows('bendahara'))) {
            abort(403);
        }

        $request->validate([
            'favicon' => 'required|image|mimes:ico,png|max:512',
        ]);

        $filename = 'favicon_' . time() . '.' . $request->favicon->extension();
        $path = $request->file('favicon')->storeAs('assets/img', $filename, 'public');

        // Hapus favicon lama jika ada
        $oldFavicon = Setting::where('key', 'site_favicon')->first();
        if ($oldFavicon) {
            $oldPath = public_path(str_replace(asset('/'), '', $oldFavicon->value));
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $faviconUrl = asset('storage/' . $path);
        Setting::updateOrCreate(['key' => 'site_favicon'], ['value' => $faviconUrl, 'type' => 'branding']);

        return redirect()->route('admin.settings.index')
                        ->with('success', 'Favicon berhasil diunggah.');
    }
}