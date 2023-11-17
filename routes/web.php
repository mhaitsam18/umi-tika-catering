<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPaketController;
use App\Http\Controllers\AdminPemesananController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberPemesananController;
use App\Http\Controllers\MemberTestimoniController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/tentang-kami', [HomeController::class, 'tentangkami'])->name('home.tentang-kami');
Route::get('/testimoni', [HomeController::class, 'testimoni'])->name('home.testimoni');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('get.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/file/tmp-upload', [FileController::class, 'tmpUpload'])->name('tmp-upload');
    Route::delete('/file/tmp-delete', [FileController::class, 'tmpDelete'])->name('tmp-delete');

    Route::post('/file/dokumen-upload', [FileController::class, 'dokumenUpload'])->name('dokumen-upload');
    Route::delete('/file/dokumen-delete', [FileController::class, 'dokumenDelete'])->name('dokumen-delete');

    Route::put('update-photo/{user}', [AuthController::class, 'updatePhoto'])->name('admin.psikolog-update-foto');
    Route::middleware('member')->group(function () {
        Route::get('/catering', [HomeController::class, 'catering'])->name('home.catering');
        Route::prefix('member')->group(function () {
            Route::get('/profile', [MemberController::class, 'profile'])->name('member.profile');
            Route::put('/profile', [MemberController::class, 'updateProfile'])->name('member.profile.update');
            Route::put('/member', [MemberController::class, 'updateMember'])->name('member.member.update');


            Route::get('/pilih-menu', [MemberPemesananController::class, 'pilihMenu'])->name('member.pemesanan.pilih-menu');
            Route::get('/pesanan-saya', [MemberPemesananController::class, 'index'])->name('member.pemesanan.index');
            Route::get('/riwayat-pemesanan', [MemberPemesananController::class, 'riwayat'])->name('member.pemesanan.riwayat');

            Route::get('/get-pemesanan', [MemberPemesananController::class, 'getPemesananData'])->name('get-pemesanan');
            Route::get('/get-riwayat', [MemberPemesananController::class, 'getRiwayatData'])->name('get-riwayat');
            Route::get('/get-detail-pemesanan/{id}', [MemberPemesananController::class, 'getPemesananDetails']);

            Route::post('/testimoni', [MemberTestimoniController::class, 'store'])->name('member.testimoni.store');
            Route::post('/pemesanan/testimoni', [MemberPemesananController::class, 'testimoni'])->name('member.pemesanan.testimoni');
            Route::get('/get-testimoni/{item}', [MemberTestimoniController::class, 'getTestimoniByItemId'])->name('get-testimoni');


            Route::get('/keranjang', [MemberPemesananController::class, 'keranjang'])->name('member.keranjang');
            Route::post('/checkout', [MemberPemesananController::class, 'checkout'])->name('member.pemesanan.checkout');
            Route::post('/add-cart', [MemberPemesananController::class, 'addToCart'])->name('cart.add');
            Route::post('/update-cart', [MemberPemesananController::class, 'updateItem'])->name('cart.update');
            Route::post('/remove-cart', [MemberPemesananController::class, 'removeItem'])->name('cart.remove');
        });
    });
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
            Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
            Route::get('/admin', [AdminUserController::class, 'admin'])->name('admin.user.admin');
            Route::get('/administrator', [AdminUserController::class, 'admin'])->name('admin.user.administrator');

            Route::get('/administrator', [AdminUserController::class, 'admin'])->name('admin.user.administrator');

            Route::resource('user', AdminUserController::class);

            Route::get('/member', [AdminUserController::class, 'member'])->name('admin.user.member');
            Route::resource('paket', AdminPaketController::class)->parameters([
                'paket' => 'paket'
            ]);
            Route::resource('jadwal-menu', AdminMenuController::class)->parameters([
                'jadwal-menu' => 'menu'
            ]);
            Route::resource('menu', AdminMenuController::class)->parameters([
                'menu' => 'menu'
            ]);
            Route::get('/pemesanan-pembayaran', [AdminPemesananController::class, 'index'])->name('admin.pemesanan.index');
            Route::put('/pemesanan/{pemesanan}', [AdminPemesananController::class, 'update'])->name('admin.pemesanan.update');
            Route::get('/item/{pemesanan}', [AdminItemController::class, 'index'])->name('admin.item.index');
            Route::post('/item', [AdminItemController::class, 'store'])->name('admin.item.store');
            Route::put('/item/{item}', [AdminItemController::class, 'update'])->name('admin.item.update');
            Route::delete('/item/{item}', [AdminItemController::class, 'destroy'])->name('admin.item.delete');
        });
    });
});
