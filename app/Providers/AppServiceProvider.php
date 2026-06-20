<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Share notification count with all admin views
        View::composer('layouts.admin', function ($view) {
            $notificationCount = 0;

            if (Schema::hasTable('posts')) {
                $notificationCount += DB::table('posts')->where('status', 'draft')->count();
            }

            if (Schema::hasTable('inventaris_barangs')) {
                $notificationCount += DB::table('inventaris_barangs')
                    ->where('status', '!=', 'baik')
                    ->orWhere('jumlah', '<', 10)
                    ->count();
            }

            $view->with('notificationCount', $notificationCount);
        });
    }
}
