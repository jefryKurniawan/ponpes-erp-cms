<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Cms\WelcomeController;

/*
|--------------------------------------------------------------------------
| CMS Routes (Public-Facing)
|--------------------------------------------------------------------------
|
| These routes are for the public CMS frontend of the Pesantren CMS.
| They are accessible without authentication.
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('cms.home');
Route::get('/tentang-kami', [WelcomeController::class, 'about'])->name('cms.about');

// News/Blog Routes
Route::get('/berita', [WelcomeController::class, 'newsIndex'])->name('cms.news.index');
Route::get('/berita/{slug}', [WelcomeController::class, 'newsShow'])->name('cms.news.show');

// PSB (Pendaftaran Santri Baru) Routes
Route::get('/psb', [WelcomeController::class, 'psb'])->name('cms.psb');
Route::get('/psb/daftar', [WelcomeController::class, 'psbForm'])->name('cms.psb.form');
Route::post('/psb/daftar', [WelcomeController::class, 'psbSubmit'])->name('cms.psb.submit');
Route::get('/psb/terima-kasih', [WelcomeController::class, 'psbThankYou'])->name('cms.psb.thankyou');

// Gallery Route
Route::get('/galeri', [WelcomeController::class, 'gallery'])->name('cms.gallery');

// TODO: Add more routes for gallery, contact, etc.