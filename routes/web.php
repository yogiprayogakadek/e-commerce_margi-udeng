<?php
use Illuminate\Support\Facades\Route;

// LANDING PAGE
Route::namespace('Landing')->group(function() {
    Route::controller(LandingController::class)
        ->prefix('/')
        ->as('landing.')
        // ->middleware('httpHeader')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/by-cat/{kategori_id}', 'byCategory')->name('by.category');
            Route::get('/detail-produk/{produk_id}', 'detailProduk')->name('detail.produk');

            Route::prefix('post')
                ->as('post.')
                ->group(function() {
                    Route::get('/{produk_id}', 'post')->name('index');
                    Route::post('/detail-by-size', 'postBySize')->name('by.size');
                });
        });

    Route::controller(CartController::class)
        ->prefix('/cart')
        ->as('cart.')
        ->group(function() {
            Route::post('/add', 'addToCart')->name('add');
            Route::get('/render', 'render')->name('render');
            Route::get('/remove/{cart_id}', 'remove')->name('remove');
            Route::get('/detail/{user_id}', 'detail')->name('detail');
        });

    Route::controller(ShoppingCartController::class)
        ->prefix('/shopping-cart')
        ->as('shopping.cart.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/remove-item/{cart_id}', 'removeItem')->name('remove.item');
            Route::post('/checkout', 'checkout')->name('checkout');
            Route::post('/payment-checking', 'paymentChecking')->name('payment.checking');
            Route::get('/regency/{province_id}', 'searchRegencies')->name('search.regency');
            Route::get('/district/{regency_id}', 'searchDistricts')->name('search.district');
            Route::get('/village/{regency_id}', 'searchVillages')->name('search.village');
        });

    Route::controller(AccountController::class)
        ->prefix('/account')
        ->as('account.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::get('/detail-order/{order_id}', 'detailOrder')->name('detail.order');
            Route::post('/update', 'update')->name('update');
            Route::post('/update-password', 'updatePassword')->name('update.password');
            Route::post('/payment', 'payment')->name('payment');
        });
});

// ADMIN PAGE
Route::middleware(['auth', 'checkRole:admin'])->namespace('Main')->group(function() {
    Route::controller(DashboardController::class)
        ->prefix('dashboard')
        ->as('dashboard.')
        ->group(function() {
            Route::get('/', 'index')->name('index');
            Route::post('/chart', 'chart')->name('chart');
            Route::post('/chart-by-kategori', 'chartByKategori')->name('chart.kategori');
            Route::post('/chart-pendapatan', 'chartPendapatan')->name('chart.pendapatan');
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

        Route::controller(OrderController::class)
        ->prefix('order')
        ->as('order.')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/print', 'print')->name('print');
        });
});

Route::middleware('guest')->namespace('Main')->group(function () {
    Route::controller(SignupController::class)
        ->prefix('signup')
        ->as('signup.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'signup')->name('signup');
        });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
