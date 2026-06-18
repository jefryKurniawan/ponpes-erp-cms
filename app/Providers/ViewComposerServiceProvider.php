<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Share settings data with all views
        View::composer('*', function ($view) {
            $settings = Setting::where('type', 'pesantren')->first();
            $view->with('settings', $settings);
        });

        // Share navigation data with all views
        View::composer('*', function ($view) {
            $navigation = [
                ['name' => 'Beranda', 'url' => route('cms.home'), 'icon' => 'fas fa-home'],
                ['name' => 'Tentang Kami', 'url' => route('cms.about'), 'icon' => 'fas fa-info-circle'],
                ['name' => 'Berita & Kegiatan', 'url' => route('cms.news.index'), 'icon' => 'fas fa-newspaper'],
                ['name' => 'Galeri Foto', 'url' => route('cms.gallery'), 'icon' => 'fas fa-image'],
                ['name' => 'Pendaftaran Santri Baru', 'url' => route('cms.psb'), 'icon' => 'fas fa-school'],
            ];
            $view->with('navigation', $navigation);
        });
    }
}