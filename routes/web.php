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

Route::get('/', Web\Home\Index::class)->name('home');
Route::get('/products', Web\Products\Index::class)->name('web.product.index');
Route::get('/category/{slug}', Web\Category\Show::class)->name('web.category.show');
Route::get('/products/{slug}', Web\Products\Show::class)->name('web.product.show');
