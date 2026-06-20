<?php

namespace App\Http\Controllers\Web\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\PsbApplication;

class WelcomeController extends Controller
{
    /**
     * Show the CMS homepage.
     */
    public function index()
    {
        // Default empty collections to avoid errors when tables are missing.
        $recentPosts = collect();
        $galleryImages = collect();
        $settings = null;

        // Safely fetch recent posts if the table exists.
        if (Schema::hasTable('posts')) {
            $recentPosts = Post::where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        }

        // Safely fetch gallery images if the table exists.
        if (Schema::hasTable('galleries')) {
            $galleryImages = Gallery::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        }

        // Safely fetch settings if the table exists.
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.home', compact('recentPosts', 'galleryImages', 'settings'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $history = null;
        $visionMission = null;
        $settings = null;

        if (Schema::hasTable('settings')) {
            $history = DB::table('settings')->where('type', 'history')->first();
            $visionMission = DB::table('settings')->where('type', 'vision_mission')->first();
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.about', compact('history', 'visionMission', 'settings'));
    }

    /**
     * Show the news listing page.
     */
    public function newsIndex(Request $request)
    {
        $posts = collect();
        $settings = null;
        if (Schema::hasTable('posts')) {
            $query = Post::where('status', 'published')
                ->with('category');

            if ($request->filled('q')) {
                $search = $request->input('q');
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            }

            $posts = $query->orderBy('published_at', 'desc')
                ->paginate(6);
        }

        // Safely fetch settings if the table exists.
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.news.index', compact('posts', 'settings'));
    }

    /**
     * Show a single news/post detail.
     */
    public function newsShow($slug)
    {
        $settings = null;
        $post = null;
        $relatedPosts = collect();

        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
        }
        if (Schema::hasTable('posts')) {
            $post = Post::where('slug', $slug)
                ->where('status', 'published')
                ->with('category')
                ->first();

            if ($post) {
                $relatedPosts = Post::where('status', 'published')
                    ->where('id', '<>', $post->id)
                    ->where('category_id', $post->category_id)
                    ->limit(3)
                    ->get();
            }
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.news.show', compact('settings', 'post', 'relatedPosts'));
    }

    /**
     * Show the PSB (Pendaftaran Santri Baru) page.
     */
    public function psb()
    {
        $settings = null;
        $psbInfo = null;
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
            $psbInfo = DB::table('settings')->where('type', 'psb_info')->first();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.psb.index', compact('settings', 'psbInfo'));
    }

    /**
     * Show the PSB form.
     */
    public function psbForm()
    {
        $settings = null;
        $psbForm = null;
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
            $psbForm = DB::table('settings')->where('type', 'psb_form')->first();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.psb.form', compact('settings', 'psbForm'));
    }

    /**
     * Handle PSB form submission.
     */
    public function psbSubmit(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'nama_wali' => 'required|string|max:255',
            'pekerjaan_wali' => 'required|string|max:255',
            'no_telepon_wali' => 'required|string|max:20',
        ]);

        // Save the PSB application to the database
        \App\Models\PsbApplication::create($request->only([
            'nama_lengkap',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'no_telepon',
            'email',
            'asal_sekolah',
            'nama_wali',
            'pekerjaan_wali',
            'no_telepon_wali',
        ]));
        return redirect()->route('cms.psb.thankyou')
            ->with('success', 'Pendaftaran Anda telah diterima. Kami akan menghubungi Anda dalam 2x24 jam.');
    }

    /**
     * Show PSB thank you page.
     */
    public function psbThankYou()
    {
        $settings = null;
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.psb.thankyou', compact('settings'));
    }

    /**
     * Show the gallery page.
     */
    public function gallery()
    {
        $settings = null;
        $galleryImages = collect();
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->where('type', 'pesantren')->first();
        }
        if (Schema::hasTable('galleries')) {
            $galleryImages = Gallery::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // Ensure $settings is never null to prevent property access errors
        if (!$settings) {
            $settings = (object) [
                'nama_pesantren' => 'Pesantren',
                'isi' => 'Pesantren CMS - Sistem Manajemen Pesantren Modern',
                'tahun_berdiri' => 'XXXX',
                'pendiri' => 'Nama Pendiri'
            ];
        }

        return view('cms.gallery', compact('settings', 'galleryImages'));
    }
}