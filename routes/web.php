<?php

use Illuminate\Support\Facades\Route;

// LANDING PAGE
Route::namespace('Landing')->group(function() {
    Route::controller(LandingController::class)
        ->prefix('/')
        ->as('landing.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/detail-produk/{produk_id}', 'detailProduk')->name('detail.produk');
        });
});

// ADMIN PAGE
Route::namespace('Main')->group(function() {
    Route::controller(DashboardController::class)
        ->prefix('dashboard')
        ->as('dashboard.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
    });

    Route::controller(KategoriController::class)
        ->prefix('kategori')
        ->as('kategori.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/print', 'print')->name('print');
        });

    Route::controller(ProdukController::class)
        ->prefix('produk')
        ->as('produk.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::get('/print', 'print')->name('print');

            Route::prefix('data')
                ->as('data.')
                ->group(function() {
                    Route::get('/render/{produk_id}', 'dataRender')->name('render');
                    Route::get('/create/{produk_id}', 'dataCreate')->name('create');
                    Route::post('/store', 'dataStore')->name('store');
                    Route::post('/edit', 'dataEdit')->name('edit');
                    Route::post('/update', 'dataUpdate')->name('update');
                    Route::post('/delete', 'dataDelete')->name('delete');
                });
        });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
