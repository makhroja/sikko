<?php

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

Auth::routes(['register' => false, 'forgot_password' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('profile', 'UserController@profile')->name('user.profile');
Route::put('profile', 'UserController@profil_update')->name('profil.update');


Route::prefix('pemilik')->middleware(['auth','pemilik'])->group(function () {
    Route::get('dashboard', 'UserController@pemilik_dashboard')->name('pemilik.dashboard');

    Route::resource('user', UserController::class);

    Route::resource('kamar', KamarController::class);

    Route::resource('penghuni', PenghuniController::class);

    Route::resource('keluhan', KeluhanController::class);

    Route::resource('tagihan', TagihanController::class);

    Route::resource('faktur', FakturController::class);

    Route::resource('pengeluaran', PengeluaranController::class);

    Route::get('keuangan', 'FakturController@keuangan')->name('pemilik.keuangan');
});

Route::prefix('penghuni')->middleware(['auth','penghuni'])->group(function () {
    Route::get('dashboard', 'PenghuniKosController@penghuni_dashboard')->name('penghuni.dashboard');
    Route::get('tagihan', 'PenghuniKosController@tagihan')->name('penghuni.tagihan');
    Route::post('bayar', 'PenghuniKosController@bayarTagihan')->name('penghuni.bayar');

    Route::get('keluhan', 'PenghuniKosController@keluhan')->name('penghuni.keluhan');
    Route::post('keluhan', 'PenghuniKosController@keluhan_store')->name('penghuni.keluhan_store');
    Route::get('keluhan/{keluhan}/edit', 'PenghuniKosController@keluhan_edit')->name('penghuni.keluhan_edit');
    Route::put('keluhan/{keluhan}', 'PenghuniKosController@keluhan_update')->name('penghuni.keluhan_update');
    Route::delete('keluhan/{keluhan}', 'PenghuniKosController@keluhan_destroy')->name('penghuni.keluhan_destroy');
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('error.404');
})->where('page','.*');
