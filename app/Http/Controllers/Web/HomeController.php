<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\User;
use App\Models\InMail;
use App\Models\OutMail;
use App\Models\CashBook;
use App\Models\Post;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @param  App\Models\Santri    $santri
     * @param  App\Models\User      $user
     * @param  App\Models\InMail    $inMail
     * @param  App\Models\OutMail   $outMail
     * @param  App\Models\CashBook  $cashBook
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function index(Santri $santri, User $user, InMail $inMail, OutMail $outMail, CashBook $cashBook)
    {
        $santri   = $santri->count();
        $users    = $user->count();
        $in_mail  = $inMail->count();
        $out_mail = $outMail->count();

        // Enhanced keuangan statistics for dashboard
        $pemasukan = $cashBook->where('tipe', 'pemasukan')->sum('debit');
        $pengeluaran = $cashBook->where('tipe', 'pengeluaran')->sum('credit');
        $saldo = $pemasukan - $pengeluaran;

        // Count CMS content
        $postsCount = Schema::hasTable('posts') ? Post::count() : 0;
        $galleryCount = Schema::hasTable('galleries') ? Gallery::count() : 0;
        $totalContent = $postsCount + $galleryCount + $in_mail + $out_mail;

        // Stock alerts (inventaris)
        $stockAlerts = 0;
        if (Schema::hasTable('inventaris_barangs')) {
            $stockAlerts = DB::table('inventaris_barangs')
                ->where('status', '!=', 'baik')
                ->orWhere('jumlah', '<', 10)
                ->count();
        }

        // Recent activities for feed
        $recentActivities = [];

        // Add recent posts
        if (Schema::hasTable('posts')) {
            $recentPosts = Post::orderBy('created_at', 'desc')->limit(2)->get();
            foreach ($recentPosts as $post) {
                $recentActivities[] = [
                    'type' => 'cms',
                    'icon' => 'edit_note',
                    'title' => 'New article published',
                    'description' => '"' . $post->title . '"',
                    'time' => $post->created_at->diffForHumans(),
                ];
            }
        }

        // Add recent galleries
        if (Schema::hasTable('galleries')) {
            $recentGalleries = Gallery::orderBy('created_at', 'desc')->limit(1)->get();
            foreach ($recentGalleries as $gallery) {
                $recentActivities[] = [
                    'type' => 'cms',
                    'icon' => 'image',
                    'title' => 'New photos added',
                    'description' => $gallery->caption ?? 'Gallery updated',
                    'time' => $gallery->created_at->diffForHumans(),
                ];
            }
        }

        // Add recent registrations
        if (Schema::hasTable('psb_applications')) {
            $recentApps = DB::table('psb_applications')
                ->orderBy('created_at', 'desc')
                ->limit(1)
                ->get();
            foreach ($recentApps as $app) {
                $recentActivities[] = [
                    'type' => 'erp',
                    'icon' => 'person_add',
                    'title' => 'New student registration',
                    'description' => $app->nama_lengkap ?? 'New applicant',
                    'time' => \Carbon\Carbon::parse($app->created_at)->diffForHumans(),
                ];
            }
        }

        // Count notifications (pending reviews, low stock, etc.)
        $notificationCount = 0;
        if (Schema::hasTable('posts')) {
            $notificationCount += Post::where('status', 'draft')->count();
        }
        $notificationCount += $stockAlerts;

        return view('admin-home', compact(
            'santri',
            'users',
            'pemasukan',
            'pengeluaran',
            'saldo',
            'in_mail',
            'out_mail',
            'totalContent',
            'stockAlerts',
            'notificationCount',
            'recentActivities'
        ));
    }
}
