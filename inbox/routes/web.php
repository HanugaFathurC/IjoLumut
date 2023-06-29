<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\PermissionController;
use App\Http\Controllers\Backoffice\RoleController;
use App\Http\Controllers\Backoffice\UserController;
use App\Http\Controllers\Backoffice\CategoryController;
use App\Http\Controllers\Backoffice\TypeController;
use App\Http\Controllers\Backoffice\WarehouseController;
use App\Http\Controllers\Backoffice\ProductController;
use App\Http\Controllers\Backoffice\ProductStockController;
use App\Http\Controllers\Backoffice\WarehouseCapacityController;
use App\Http\Controllers\Backoffice\TransactionController;
use App\Http\Controllers\Backoffice\OrderController;
use App\Http\Controllers\Backoffice\CriteriaController;
use App\Http\Controllers\Backoffice\ReportIncomeController;
use App\Http\Controllers\Backoffice\ReportProductInController;
use App\Http\Controllers\Landing\CartController;
use App\Http\Controllers\Landing\AboutUsController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\ProductController as LandingProductController;
use App\Http\Controllers\Landing\TransactionController as LandingTransactionController;
use App\Http\Controllers\Landing\TypeController as LandingTypeController;
use App\Http\Controllers\Landing\TransactionSuccessController;


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

Route::get('/', HomeController::class)->name('home');

Route::controller(LandingProductController::class)->as('product.')->group(function(){
    Route::get('/product', 'index')->name('index');
    Route::get('/product/{product:slug}', 'show')->name('show');
});

Route::controller(LandingTypeController::class)->as('type.')->group(function(){
    Route::get('/type/{type:slug}', 'show')->name('show');
});

Route::post('/transaction', LandingTransactionController::class)->middleware('auth')->name('transaction.store');

Route::get('/transaction-success', [TransactionSuccessController::class, 'index'])->name('transaction-success');

Route::get('payment/success', [LandingTransactionController::class, 'midtransCallback']);
Route::post('payment/success', [LandingTransactionController::class, 'midtransCallback']);

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

Route::controller(CartController::class)->middleware('auth')->as('cart.')->group(function(){
    Route::get('/cart', 'index')->name('index');
    Route::post('/cart/{product:id}', 'store')->name('store');
    Route::put('/cart/update/{cart:id}', 'update')->name('update');
    Route::delete('/cart/delete/{cart}', 'destroy')->name('destroy');
});

Route::group(['prefix' => 'backoffice', 'as' => 'backoffice.', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('/permission', PermissionController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/type', TypeController::class);
    Route::post('/warehouse/create/cities', [WarehouseController::class, 'cities'])->name('warehouse.create.cities');
    Route::post('/warehouse/create/districts', [WarehouseController::class, 'districts'])->name('warehouse.create.districts');
    Route::post('/warehouse/create/villages', [WarehouseController::class, 'villages'])->name('warehouse.create.villages');
    Route::resource('/warehouse', WarehouseController::class);
    Route::resource('/product', ProductController::class);
    Route::controller(ProductStockController::class)->prefix('/product-stock')->as('product-stock.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::put('/update/{id}', 'update')->name('update');
    });
    Route::controller(WarehouseCapacityController::class)->prefix('/warehouse-capacity')->as('warehouse-capacity.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::put('/update/{id}', 'update')->name('update');
    });
    Route::get('/criteria', [CriteriaController::class, 'index'])->name('criteria.index');
    Route::get('/criteria/{criteria}/edit', [CriteriaController::class, 'edit'])->name('criteria.edit');
    Route::put('/criteria/{criteria}', [CriteriaController::class, 'update'])->name('criteria.update');
    Route::get('/transaction', TransactionController::class)->name('transaction');
    Route::resource('/order', OrderController::class);
    Route::controller(ReportProductInController::class)->prefix('/report-product-in')->as('report-product-in.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/filter', 'filter')->name('filter');
        Route::get('/pdf/{fromDate}/{toDate}', 'pdf')->name('pdf');
      });
    Route::controller(ReportIncomeController::class)->prefix('/report-income')->as('report-income.')->group(function(){
        Route::get('/index', 'index')->name('index');
        Route::get('/filter', 'filter')->name('filter');
        Route::get('/pdf/{fromDate}/{toDate}', 'pdf')->name('pdf');
      });
});
