<?php

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

Route::view('/aanvraag', 'aanvraag');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'landingpage');
Route::view('/home', 'home');
Route::view('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');

Route::get('qryVerant', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
Route::resource('verantwoordelijke', 'Admin\VerantwoordelijkeController');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

});
