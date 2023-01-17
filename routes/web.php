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
    Route::get('/', [App\Http\Controllers\StoreController::class, 'index'])->name('.index');
    Route::post('/', [App\Http\Controllers\StoreController::class, 'create'])->name('.create');

    Route::get('/edit/{id?}', [App\Http\Controllers\StoreController::class, 'editForm'])->name('.edit');
    Route::post('/edit', [App\Http\Controllers\StoreController::class, 'edit'])->name('.edit');

    Route::get('/inactive/{id?}', [App\Http\Controllers\StoreController::class, 'inactive'])->name('.inactive');
});

//Sort
Route::prefix('/sort')->name('sort')->group(function () {
    Route::get('/', [App\Http\Controllers\SortController::class, 'index'])->name('.index');
    Route::post('/', [App\Http\Controllers\SortController::class, 'create'])->name('.create');
    Route::get('/edit/{id?}', [App\Http\Controllers\SortController::class, 'editForm'])->name('.edit');
    Route::post('/edit', [App\Http\Controllers\SortController::class, 'edit'])->name('.editPost');

    Route::get('/inactive/{id?}', [App\Http\Controllers\SortController::class, 'inactive'])->name('.inactive');

    Route::get('/reward/{id?}', [App\Http\Controllers\SortController::class, 'rewardPage'])->name('.rewardPage');
});

//Cotas
Route::prefix('/quotas')->name('quotas')->group(function () {
    Route::get('/', [App\Http\Controllers\QuotaController::class, 'index'])->name('.index')->middleware('auth'); 
});