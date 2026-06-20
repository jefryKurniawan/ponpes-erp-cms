<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SystemSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('admin')) {
                abort(403);
            }
            return $next($request);
        });
    }

    /**
     * Display the system settings edit form.
     */
    public function edit()
    {
        $setting = SystemSetting::singleton();
        return view('system-setting.edit', compact('setting'));
    }

    /**
     * Update the system settings in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'pesantren_name' => 'required|string|max:100',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:'.(date('Y')),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB
            'contact_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'notif_email' => 'boolean',
            'notif_sms' => 'boolean',
        ]);

        $setting = SystemSetting::singleton();
        $input = $request->all();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($setting->logo && Storage::disk('public')->exists($setting->logo)) {
                Storage::disk('public')->delete($setting->logo);
            }

            $file = $request->file('logo');
            $path = $file->store('logo', 'public');
            $input['logo'] = $path;
        } elseif (!array_key_exists('logo', $input)) {
            // Keep existing logo if no file uploaded
            $input['logo'] = $setting->logo;
        }

        // Convert checkboxes (notif_email, notif_sms) to boolean
        $input['notif_email'] = $request->has('notif_email') ? 1 : 0;
        $input['notif_sms'] = $request->has('notif_sms') ? 1 : 0;

        $setting->update($input);

        \App\Helpers\LogActivity::addToLog('Update Pengaturan Sistem');

        return redirect()->back()
            ->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}