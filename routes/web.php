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
Route::get('logout', 'Auth\LoginController@logout');

// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'landingpage');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::view('/home', 'adminpanel');
    Route::view('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');
    Route::view('verenigingen', 'Admin\VerenigingController@index');

    Route::get('qryVerenigingen','Admin\VerenigingController@qryVerenigingen');
    Route::resource('verenigingen', 'Admin\VerenigingController');

    Route::get('qryVerant', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
    Route::resource('verantwoordelijke', 'Admin\VerantwoordelijkeController');
});
