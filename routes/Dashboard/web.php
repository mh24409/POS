<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

        Route::get('/', 'DashboardController@index')->name('index');

        // user routes
        Route::resource('users', UserController::class)->except('show')->middleware('verified');
        // category routes
        Route::resource('categories', CategoryController::class)->except('show')->middleware('verified');

        // products routes
        Route::resource('products', ProductController::class)->except('show')->middleware('verified');

        // clients routes
        Route::resource('clients', ClientController::class)->except('show')->middleware('verified');

        Route::resource('client.order', 'Client\OrderController')->except('show')->middleware('verified');

        Route::resource('orders', 'OrderController')->except('show')->middleware('verified');
        Route::get('/orders/{order}/products/', 'OrderController@products')->name('orders.products')->middleware('verified');
    });
});
