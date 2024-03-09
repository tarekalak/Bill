<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
route::middleware(['auth'])->group(function(){
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    route::resource('customer',CustomersController::class);
    route::resource('product',ProductsController::class);
    route::resource('users',UserController::class);
    route::resource('role',RoleController::class);
    Route::prefix('bill')->group(function () {
        route::resource('bill',BillController::class);
        Route::get('/searchBill',BillController::class,'searchBill')->name('searchBill');
        route::get('getprice/{id}',[BillController::class,'getPrice'])->name('product.price');
    });
    Route::resource('/company',CompanyController::class);



        });
/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/



});

require __DIR__.'/auth.php';
