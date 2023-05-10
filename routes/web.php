<?php

use App\Http\Controllers\Backend\AjaxRequestController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\TankController;
use App\Http\Controllers\Backend\VehicleController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PosController::class, 'dashboard'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tank', TankController::class);
    Route::resource('stock', StockController::class);
    Route::resource('vehicle', VehicleController::class);

    //stock history
    Route::get('/tank-wise-stock', [StockController::class, 'tankWiseStock'])->name('tankWiseStock');
    Route::get('/low-stock-alert', [StockController::class, 'lowStockAlert'])->name('lowStockAlert');

    Route::get('sell/pos', [PosController::class, 'index'])->name('pos.index');
    Route::get('create-vat', [PosController::class, 'createVat'])->name('vat');
    Route::post('vat-store-update', [PosController::class, 'vatStoreUpdate'])->name('vatStoreUpdate');
    Route::post('/save-order', [PosController::class, 'saveOrder'])->name('saveOrder');
    Route::get('/dashboard', [PosController::class, 'dashboard'])->name('dashboard');

    //ajax request
    Route::get('/get-vehicle-details/{vehicle_type}', [AjaxRequestController::class, 'getVehicleDetails']);
    Route::get('/get-product-details/{id}', [AjaxRequestController::class, 'getProductDetails']);
    Route::get('/get-single-product-details/{id}', [AjaxRequestController::class, 'getSingleProductDetails']);
    Route::get('/invoice/{id}', [PosController::class, 'invoice'])->name('invoice');
    Route::get('/selling-history', [PosController::class, 'sellingHistory'])->name('sellingHistory');
    Route::get('/nabil-sell', [PosController::class, 'nabilSell'])->name('nabilSell');
    Route::get('/other-sell', [PosController::class, 'otherSell'])->name('otherSell');
});
