<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('store');



    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('get.logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/file/tmp-upload', [FileController::class, 'tmpUpload'])->name('tmp-upload');
    Route::delete('/file/tmp-delete', [FileController::class, 'tmpDelete'])->name('tmp-delete');

    Route::post('/file/dokumen-upload', [FileController::class, 'dokumenUpload'])->name('dokumen-upload');
    Route::delete('/file/dokumen-delete', [FileController::class, 'dokumenDelete'])->name('dokumen-delete');

    Route::put('update-photo/{user}', [AuthController::class, 'updatePhoto'])->name('admin.psikolog-update-foto');
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {


        });
    });
    Route::middleware('member')->group(function () {
        Route::prefix('member')->group(function () {

        });
    });
});
