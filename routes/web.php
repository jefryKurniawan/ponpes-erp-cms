<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\LogActivityController;
use App\Http\Controllers\Web\CostController;
use App\Http\Controllers\Web\RegistrationCostController;
use App\Http\Controllers\Web\SyahriahController;
use App\Http\Controllers\Web\CashBookController;
use App\Http\Controllers\Web\InMailController;
use App\Http\Controllers\Web\OutMailController;
use App\Http\Controllers\Web\SantriController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CashBookController as ApiCashBookController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SyahriahController as ApiSyahriahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('santri', SantriController::class);
    Route::resource('pengguna', UserController::class);
    Route::get('log-aktivitas', [LogActivityController::class, 'index'])->name('logs.index');

    // Biaya Pembayaran Pesantren
    Route::get('biaya', [CostController::class, 'index'])->name('biaya.index');
    Route::get('biaya/edit', [CostController::class, 'edit'])->name('biaya.edit');
    Route::patch('biaya/edit', [CostController::class, 'update'])->name('biaya.update');

    // Pembayaran Pendaftaran Santri
    Route::get('pembayaran-pendaftaran', [RegistrationCostController::class, 'index'])->name('registration.index');
    Route::get('pembayaran-pendaftaran/create', [RegistrationCostController::class, 'create'])->name('registration.create');
    Route::post('pembayaran-pendaftaran', [RegistrationCostController::class, 'store'])->name('registration.store');
    Route::get('pembayaran-pendaftaran/print/{id}', [RegistrationCostController::class, 'print'])->name('registration.print');
    Route::delete('pembayaran-pendaftaran/{id}', [RegistrationCostController::class, 'destroy'])->name('registration.destroy');

    // Syahriah (SPP)
    Route::get('syahriah', [SyahriahController::class, 'index'])->name('syahriah.index');
    Route::get('syahriah/create', [SyahriahController::class, 'create'])->name('syahriah.create');
    Route::post('syahriah', [SyahriahController::class, 'store'])->name('syahriah.store');
    Route::get('syahriah/print/{id}', [SyahriahController::class, 'print'])->name('syahriah.print');
    Route::delete('syahriah/{id}', [SyahriahController::class, 'destroy'])->name('syahriah.destroy');

    // Buku Kas
    Route::get('buku-kas', [CashBookController::class, 'index'])->name('buku-kas.index');
    Route::get('buku-kas/debit/create', [CashBookController::class, 'createDebit'])->name('buku-kas.debit.create');
    Route::post('buku-kas/debit', [CashBookController::class, 'storeDebit'])->name('buku-kas.debit.store');
    Route::get('buku-kas/credit/create', [CashBookController::class, 'createCredit'])->name('buku-kas.credit.create');
    Route::post('buku-kas/credit', [CashBookController::class, 'storeCredit'])->name('buku-kas.credit.store');
    Route::delete('buku-kas/{id}', [CashBookController::class, 'destroy'])->name('buku-kas.destroy');

    Route::resource('surat-masuk', InMailController::class);
    Route::resource('surat-keluar', OutMailController::class);

    // Keuangan
    Route::resource('keuangan', \App\Http\Controllers\Web\KeuanganController::class)->except(['show']);
    Route::get('keuangan/{cashBook}', [\App\Http\Controllers\Web\KeuanganController::class, 'show'])->name('keuangan.show');
    Route::get('keuangan/export/{type}', [\App\Http\Controllers\Web\KeuanganController::class, 'export'])->name('keuangan.export')->whereIn('type', ['pdf', 'excel']);
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {
    // Autentikasi
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Buku Kas
    Route::get('buku-kas', [ApiCashBookController::class, 'index']);

    // Ubah Password
    Route::post('password', [PasswordController::class, 'update']);

    // Profil
    Route::get('profile', [ProfileController::class, 'show']);
    Route::post('profile', [ProfileController::class, 'update']);

    // Syahriah
    Route::get('syahriah-history', [ApiSyahriahController::class, 'index_history']);
    Route::get('syahriah-spp', [ApiSyahriahController::class, 'index_spp']);

    // Keuangan API
    Route::apiResource('keuangan', \App\Http\Controllers\Api\KeuanganController::class)->only(['index', 'store']);
    Route::get('keuangan/dashboard-stats', [\App\Http\Controllers\Api\KeuanganController::class, 'dashboardStats'])->name('keuangan.dashboardStats');
});

/*
|--------------------------------------------------------------------------
| CMS Routes (Public-Facing)
|--------------------------------------------------------------------------
|
| These routes are for the public CMS frontend of the Pesantren CMS.
| They are accessible without authentication.
|
*/

Route::group(['prefix' => 'cms', 'as' => 'cms.'], function () {
    Route::get('/', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'index'])->name('home');
    Route::get('/tentang-kami', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'about'])->name('about');

    // News/Blog Routes
    Route::get('/berita', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'newsIndex'])->name('news.index');
    Route::get('/berita/{slug}', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'newsShow'])->name('news.show');

    // PSB (Pendaftaran Santri Baru) Routes
    Route::get('/psb', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'psb'])->name('psb');
    Route::get('/psb/daftar', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'psbForm'])->name('psb.form');
    Route::post('/psb/daftar', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'psbSubmit'])->name('psb.submit');
    Route::get('/psb/terima-kasih', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'psbThankYou'])->name('psb.thankyou');

    // Gallery Route
    Route::get('/galeri', [\App\Http\Controllers\Web\Cms\WelcomeController::class, 'gallery'])->name('gallery');

    // TODO: Add more routes for contact, etc.
});