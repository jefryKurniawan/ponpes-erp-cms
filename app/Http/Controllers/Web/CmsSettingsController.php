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
                                ->groupBy('type');

            return view('admin.cms.settings.index', compact('settings'));
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
            return view('admin.cms.settings.create');
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

        return redirect()->route('admin.cms.settings.index')
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
            return view('admin.cms.settings.show', compact('setting'));
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
            return view('admin.cms.settings.edit', compact('setting'));
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

        return redirect()->route('admin.cms.settings.index')
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

        return redirect()->route('admin.cms.settings.index')
                        ->with('success', 'Pengaturan CMS berhasil dihapus.');
    }
}