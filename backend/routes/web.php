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
Route::get('/', 'App\Http\Controllers\PageController@index');
Route::get('/show-all-favorites', 'App\Http\Controllers\PageController@showAllFavorites')->name('favorite_list');
Route::get('/get-all-favorites', 'App\Http\Controllers\PageController@getAllFavorites');
Route::delete('/delete-favorite-by-id/{id}', 'App\Http\Controllers\PageController@deleteById')->name('delete_favorite_by_id');
Route::post('/add-favorite', 'App\Http\Controllers\PageController@store');
Route::delete('/delete-favorite/{favoriteCity}', 'App\Http\Controllers\PageController@delete')->name('delete_favorite');