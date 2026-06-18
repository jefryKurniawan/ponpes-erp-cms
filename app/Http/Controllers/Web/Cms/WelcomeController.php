<?php

namespace App\Http\Controllers\Web\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\Post;
use App\Models\Gallery;

class WelcomeController extends Controller
{
    /**
     * Show the CMS homepage.
     */
    public function index()
    {
        // Get settings for the pesantren
        $settings = Setting::where('type', 'pesantren')->first();

        // Get recent posts/news
        $recentPosts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Get gallery images
        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('cms.home', compact('settings', 'recentPosts', 'galleryImages'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $settings = Setting::where('type', 'pesantren')->first();
        $history = Setting::where('type', 'history')->first();
        $visionMission = Setting::where('type', 'vision_mission')->first();

        return view('cms.about', compact('settings', 'history', 'visionMission'));
    }

    /**
     * Show the news listing page.
     */
    public function newsIndex()
    {
        $settings = Setting::where('type', 'pesantren')->first();
        $posts = Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('cms.news.index', compact('settings', $posts));
    }

    /**
     * Show a single news/post detail.
     */
    public function newsShow($slug)
    {
        $settings = Setting::where('type', 'pesantren')->first();
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get related posts
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->limit(3)
            ->get();

        return view('cms.news.show', compact('settings', 'post', 'relatedPosts'));
    }

    /**
     * Show the PSB (Pendaftaran Santri Baru) page.
     */
    public function psb()
    {
        $settings = Setting::where('type', 'pesantren')->first();
        $psbInfo = Setting::where('type', 'psb_info')->first();

        return view('cms.psb.index', compact('settings', 'psbInfo'));
    }

    /**
     * Show the PSB form.
     */
    public function psbForm()
    {
        $settings = Setting::where('type', 'pesantren')->first();
        $psbForm = Setting::where('type', 'psb_form')->first();

        return view('cms.psb.form', compact('settings', 'psbForm'));
    }

    /**
     * Handle PSB form submission.
     */
    public function psbSubmit(Request $request)
    {
        // Validation
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

        // TODO: Save to database or send email
        // For now, just redirect with success message

        return redirect()->route('cms.psb.thankyou')
            ->with('success', 'Pendaftaran Anda telah diterima. Kami akan menghubungi Anda dalam 2x24 jam.');
    }

    /**
     * Show PSB thank you page.
     */
    public function psbThankYou()
    {
        $settings = Setting::where('type', 'pesantren')->first();
        return view('cms.psb.thankyou', compact('settings'));
    }

    /**
     * Show the gallery page.
     */
    public function gallery()
    {
        $settings = Setting::where('type', 'pesantren')->first();
        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cms.gallery', compact('settings', 'galleryImages'));
    }
}