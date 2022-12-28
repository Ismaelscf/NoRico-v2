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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homeComplete', [App\Http\Controllers\HomeController::class, 'index'])->name('homeComplete');

Route::get('/admin/newUser', [App\Http\Controllers\UserController::class, 'index'])->name('newUser')->middleware('auth');
Route::post('/admin/newUser', [App\Http\Controllers\UserController::class, 'create'])->name('SaveNewUser')->middleware('auth');

// Stores
Route::prefix('/store')->name('store')->group(function () {
    Route::get('/', [App\Http\Controllers\StoreController::class, 'index'])->name('.index');
    Route::post('/', [App\Http\Controllers\StoreController::class, 'create'])->name('.create');

    Route::get('/editar/{id?}', [App\Http\Controllers\StoreController::class, 'editForm'])->name('.edit');
    Route::post('/editar', [App\Http\Controllers\StoreController::class, 'edit'])->name('edit');

    Route::get('/inactive/{id?}', [App\Http\Controllers\StoreController::class, 'inactive'])->name('.inactive');
});