<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('home'); 
// });

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route auth
Auth::routes();

// route system
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['notUser'])->group(function () {
        Route::resource('menus', App\Http\Controllers\C_menu::class);

        Route::resource('menu-firsts', App\Http\Controllers\C_menu_first::class)->parameters([
            'menu-firsts' => 'menu_first:uuid'
        ]);

        Route::resource('menu-seconds', App\Http\Controllers\C_menu_second::class)->parameters([
            'menu-seconds' => 'menu_second:uuid'
        ]);

        Route::resource('roles', App\Http\Controllers\C_role::class)->parameters([
            'roles' => 'role:uuid'
        ]);

        Route::resource('settings', App\Http\Controllers\C_setting::class)->parameters([
            'settings' => 'setting:uuid'
        ]);

        Route::resource('menu-accesses', App\Http\Controllers\C_menu_access::class)->parameters([
            'menu-accesses' => 'menu_access:uuid'
        ]);

        Route::resource('users', App\Http\Controllers\C_user::class)->parameters([
            'users' => 'user:uuid'
        ]);

        Route::resource('business-profiles', App\Http\Controllers\C_business_profile::class)->parameters([
            'business-profiles' => 'business_profile:uuid'
        ]);

        Route::resource('metode-pembayaran', App\Http\Controllers\C_metode_pembayaran::class)->parameters([
            'metode-pembayaran' => 'metode_pembayaran:uuid'
        ]);

        Route::resource('contacts', App\Http\Controllers\C_contact::class)->parameters([
            'contacts' => 'contact:uuid'
        ]);

        Route::resource('mobil', App\Http\Controllers\C_mobil::class)->parameters([
            'mobil' => 'mobil:uuid'
        ]);
    });

    Route::resource('profiles', App\Http\Controllers\C_profile::class)->parameters([
        'profiles' => 'profile:uuid'
    ]);

    Route::get('penyewaan/cetak-penyewaan/{uuid_penyewaan}', [App\Http\Controllers\C_penyewaan::class, 'cetak_penyewaan'])->name('penyewaan.cetak-penyewaan');
    Route::put('penyewaan/update_status/{uuid_penyewaan}', [App\Http\Controllers\C_penyewaan::class, 'update_status'])->name('penyewaan.update_status');
    Route::resource('penyewaan', App\Http\Controllers\C_penyewaan::class)->parameters([
        'penyewaan' => 'penyewaan:uuid'
    ]);
});
