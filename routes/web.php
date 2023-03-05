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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recuperarSenha', [App\Http\Controllers\SenhaController::class, 'recuperarSenha'])->name('recuperarSenha');
Route::post('/senha', [App\Http\Controllers\SenhaController::class, 'senha'])->name('senha');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
//Users
Route::prefix('/user')->name('user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('.home')->middleware('auth');
    Route::get('/newUser', [App\Http\Controllers\UserController::class, 'index'])->name('.newUser')->middleware('auth');
    Route::post('/newUser', [App\Http\Controllers\UserController::class, 'create'])->name('.save')->middleware('auth');
    Route::get('/status/{id?}', [App\Http\Controllers\UserController::class, 'mudarStatus'])->name('.status')->middleware('auth');
    Route::get('/edit/{id?}', [App\Http\Controllers\UserController::class, 'edit'])->name('.edit')->middleware('auth');
    Route::post('/edit', [App\Http\Controllers\UserController::class, 'editUser'])->name('.editUser')->middleware('auth');
});

// Stores
Route::prefix('/store')->name('store')->group(function () {
    Route::get('/', [App\Http\Controllers\StoreController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/', [App\Http\Controllers\StoreController::class, 'create'])->name('.create')->middleware('auth');

    Route::get('/edit/{id?}', [App\Http\Controllers\StoreController::class, 'editForm'])->name('.edit')->middleware('auth');
    Route::post('/edit', [App\Http\Controllers\StoreController::class, 'edit'])->name('.editPost')->middleware('auth');

    Route::get('/inactive/{id?}', [App\Http\Controllers\StoreController::class, 'inactive'])->name('.inactive')->middleware('auth');
});

//Sort
Route::prefix('/sort')->name('sort')->group(function () {
    Route::get('/', [App\Http\Controllers\SortController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/', [App\Http\Controllers\SortController::class, 'create'])->name('.create')->middleware('auth');
    Route::get('/edit/{id?}', [App\Http\Controllers\SortController::class, 'editForm'])->name('.edit')->middleware('auth');
    Route::post('/edit', [App\Http\Controllers\SortController::class, 'edit'])->name('.editPost')->middleware('auth');
    Route::post('/winner', [App\Http\Controllers\SortController::class, 'winner'])->name('.winner')->middleware('auth');
    Route::get('/inactive/{id?}', [App\Http\Controllers\SortController::class, 'inactive'])->name('.inactive')->middleware('auth');
    Route::get('/reward/{id?}', [App\Http\Controllers\SortController::class, 'rewardPage'])->name('.rewardPage')->middleware('auth');
});

//Cotas
Route::prefix('/quotas')->name('quotas')->group(function () {
    Route::get('/', [App\Http\Controllers\QuotaController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/', [App\Http\Controllers\QuotaController::class, 'create'])->name('.create')->middleware('auth');
    Route::get('/edit/{id?}', [App\Http\Controllers\QuotaController::class, 'edit'])->name('.edit')->middleware('auth');
    Route::post('/edit', [App\Http\Controllers\QuotaController::class, 'editQuota'])->name('.editQuota')->middleware('auth');
    Route::get('/status/{id?}', [App\Http\Controllers\QuotaController::class, 'mudarStatus'])->name('.status')->middleware('auth');
    Route::get('/hiring/{id?}', [App\Http\Controllers\QuotaController::class, 'hiring'])->name('.hiring')->middleware('auth');
    Route::post('/hiring', [App\Http\Controllers\QuotaController::class, 'installments'])->name('.installments')->middleware('auth');

});

//Parcelas
Route::prefix('/installment')->name('installment')->group(function () {
    Route::get('/', [App\Http\Controllers\InstallmentController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/', [App\Http\Controllers\InstallmentController::class, 'buscarDadosParcelas'])->name('.buscarDadosParcelas')->middleware('auth');
    Route::get('/pay/{id?}', [App\Http\Controllers\InstallmentController::class, 'pay'])->name('.pay')->middleware('auth');
    Route::get('/delay/{id?}', [App\Http\Controllers\InstallmentController::class, 'delay'])->name('.delay')->middleware('auth');
    Route::get('/track_parcels/{id?}', [App\Http\Controllers\InstallmentController::class, 'track_parcels'])->name('.track_parcels')->middleware('auth');
    Route::post('/track_quotas', [App\Http\Controllers\InstallmentController::class, 'track_quotas'])->name('.track_quotas')->middleware('auth');
});

//Funcionários de Lojas
Route::prefix('/employees')->name('employees')->group(function() {
    Route::get('/{id?}', [App\Http\Controllers\StoreEmployeeController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/', [App\Http\Controllers\StoreEmployeeController::class, 'create'])->name('.create')->middleware('auth');

    Route::get('/edit/{id?}', [App\Http\Controllers\StoreEmployeeController::class, 'editForm'])->name('.edit')->middleware('auth');
    Route::post('/edit', [App\Http\Controllers\StoreEmployeeController::class, 'edit'])->name('.editPost')->middleware('auth');

    Route::get('/inactive/{employee_id?}/{store_id?}', [App\Http\Controllers\StoreEmployeeController::class, 'inactive'])->name('.inactive')->middleware('auth');
});

//Vendas
Route::prefix('/sales')->name('sales')->group(function(){
    Route::get('/{id?}', [App\Http\Controllers\SaleController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/confirm', [App\Http\Controllers\SaleController::class, 'confirm'])->name('.confirm');
    Route::post('/confirmUnlimited', [App\Http\Controllers\SaleController::class, 'confirmUnlimited'])->name('.confirmUnlimited');
    Route::post('/', [App\Http\Controllers\SaleController::class, 'create'])->name('.create')->middleware('auth');
    Route::post('/searchUser', [App\Http\Controllers\SaleController::class, 'searchUser'])->name('.searchUser')->middleware('auth');
});

//Faturas
Route::prefix('/invoices')->name('invoices')->group(function(){
    Route::get('/', [App\Http\Controllers\InvoiceController::class, 'index'])->name('.index')->middleware('auth');
    Route::post('/create', [App\Http\Controllers\InstallmentController::class, 'create'])->name('.create')->middleware('auth');
});