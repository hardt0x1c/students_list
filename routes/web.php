<?php

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

Route::get('/', 'App\Http\Controllers\AbiturentController@index')->name('abiturent.index');

Route::get('/abiturents', 'App\Http\Controllers\AbiturentController@index')->name('abiturents.index');

Route::get('/abiturents/{id}', 'App\Http\Controllers\AbiturentController@show')->name('abiturents.show');

Route::post('/abiturents', 'App\Http\Controllers\AbiturentController@store');

Route::put('/abiturents/{id}', 'App\Http\Controllers\AbiturentController@update');

Route::delete('/abiturents/{id}', 'App\Http\Controllers\AbiturentController@destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
