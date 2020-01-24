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



Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::view('/aanvraag', 'aanvraag');

// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'landingpage');

Route::view('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');

//verenigingenbeheer
Route::view('/home', 'home');
Route::view('admin/verenigingen', 'Admin\VerenigingController@index');
Route::view('admin/evenementen', 'Admin\EvenementController@index');

//verantwoordelijkebeheer
Route::get('qryVerantwoordelijke', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
Route::get('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');



Route::view('/home', 'admin.adminpanel');


// json voor vrijwilligers
Route::get('admin/qryVrijwilligers', 'Admin\VrijwilligerController@qryVrijwilligers');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('qryEvenementen','Admin\EvenementController@qryEvenementen');
    Route::resource('evenementen', 'Admin\EvenementController');

    Route::get('qryVerenigingen','Admin\VerenigingController@qryVerenigingen');

    Route::resource('verenigingen', 'Admin\VerenigingController');


    Route::view('beheer', 'admin.verantwoordelijke.verantwoordelijkebeheer');

    Route::get('qryVerantwoordelijke', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
    Route::resource('verantwoordelijke', 'Admin\VerantwoordelijkeController');
    Route::get('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');


//    route vrijwilligers
    Route::resource('vrijwilligers', 'Admin\VrijwilligerController');

});
