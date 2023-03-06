<?php

use App\Http\Controllers\Amil\DashboardController;
use App\Http\Controllers\Amil\KonfirmasizakatController;
use App\Http\Controllers\Amil\MuzakiController;
use App\Http\Controllers\Amil\ProfileController;
use App\Http\Controllers\Amil\TotalzakatController;
use App\Http\Controllers\Amil\ZakatController;
use App\Http\Controllers\Muzakki\AyozakatController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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

Route::prefix('amil')->group(function () {
    Route::middleware('auth')->group(function () {

        //route dashboard amil
        Route::get('/dashboard', DashboardController::class)->name('amil.dashboard');

        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('amil.profile');
            Route::put('/profile/update/{id}', 'update')->name('amil.profile.update');
        });

        //route zakat
        Route::controller(ZakatController::class)->group(function () {
            Route::get('/zakat/perlu_dikonfirmasi', 'index')->name('amil.zakat.needconfirm');
            Route::get('/zakat/dikonfirmasi', 'zakat_confirm')->name('zakat_confirm');
            Route::get('/zakat/invoice/{id}', 'show')->name('amil.invoice.show');
            Route::get('/zakat/export/{id}', 'export')->name('amil.zakat.export');
        });

        Route::controller(MuzakiController::class)->group(function () {
            Route::get('/muzakki', 'index')->name('amil.muzakki');
            Route::get('/muzakki/show/{id}', 'show')->name('amil.muzakki.show');
            Route::get('/muzakki/export', 'export')->name('amil.muzakki.export');
        });

        Route::put('/konfirmasi_zakat/{id}', KonfirmasizakatController::class);

        Route::get('/totalzakat/export', [TotalzakatController::class, 'export'])->name('amil.totalzakat.export');
    });
});

Route::get('/', function () {

    if (auth()->guard('muzakki')->check()) {
        return redirect()->route('muzakki.dashboard');
    }
    return view('muzakki.login.index');
});

Route::prefix('muzakki')->group(function () {

    //route auth for muzakki
    Route::controller(\App\Http\Controllers\Muzakki\AuthController::class)->group(function () {
        Route::get('/register', 'register')->name('muzakki.register');
        Route::post('/register', 'store')->name('muzakki.store');
        Route::post('/login', 'login')->name('muzakki.login');
        Route::get('/destroy', 'destroy')->name('muzakki.destroy');
    });

    Route::get('/auth/{provider}', [\App\Http\Controllers\Muzakki\SocialiteController::class, 'redirectToProvider']);
    Route::get('/auth/{provider}/callback', [\App\Http\Controllers\Muzakki\SocialiteController::class, 'handleProvideCallback']);

    Route::middleware('muzakki')->group(function () {
        Route::get('/dashboard', \App\Http\Controllers\Muzakki\DashboardController::class)->name('muzakki.dashboard');

        //route admin profile
        Route::controller(\App\Http\Controllers\Muzakki\ProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('muzakki.profile');
            Route::put('/profile/update/{id}', 'update')->name('muzakki.profile.update');
        });

        //route inv
        Route::controller(\App\Http\Controllers\Muzakki\InvociceController::class)->group(function () {
            Route::get('/invoice', 'index')->name('muzakki.invoice');
            Route::post('/invoice/store', 'store')->name('muzakki.inovice.store');
        });

        Route::controller(\App\Http\Controllers\Muzakki\KonfirmasiController::class)->group(function () {
            Route::get('/konfirmasi', 'index')->name('muzakki.konformasi');
            Route::post('/konfirmasi/store', 'store')->name('muzakki.konfirmasi.store');
        });

        Route::get('/riwayatzakat', [\App\Http\Controllers\Muzakki\RiwayatzakatController::class, 'index'])->name('muzakki.riwayat.zakat');

        Route::get('/zakat_pending', [\App\Http\Controllers\Muzakki\ZakatpendingController::class, 'index'])->name('muzakki.zakat.pending');
    });
});

Route::post('payments/midtrans-notification', [\App\Http\Controllers\Muzakki\PaymentCallbackController::class, 'receive']);
Route::get('/pembayaran_sukses', [\App\Http\Controllers\Muzakki\PaymentCallbackController::class, 'success']);

Route::get('/ayozakat', AyozakatController::class);

Route::get('/offline', function () {
    return view('offline');
});
