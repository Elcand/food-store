<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', Auth\Register::class)->name('register');
Route::get('/login', Auth\Login::class)->name('login');

Route::middleware('auth:customer')->group(function () {
    Route::group(['prefix' => 'account'], function () {
        Route::get('/my-orders', Account\MyOrders\Index::class)->name('account.my-orders.index');
        Route::get('/my-orders/{snap_token}', Account\MyOrders\Index::class)->name('account.my-orders.show');
        Route::get('/my-profile', Account\MyProfile\Index::class)->name('account.my-profile');
        Route::get('/password', Account\Password\Index::class)->name('account.password');
    });
});
