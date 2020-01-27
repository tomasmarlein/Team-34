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
Route::view('/documentatie', 'Documentatie');

// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'landingpage');




Route::middleware(['auth', 'admin'])->group(function () {
    Route::view('/home', 'admin.adminpanel');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    //evenementen
    Route::get('qryEvenementen','Admin\EvenementController@qryEvenementen');
    Route::resource('evenementen', 'Admin\EvenementController');

    //vereniginen
    Route::get('qryVerenigingen','Admin\VerenigingController@qryVerenigingen');
    Route::resource('verenigingen', 'Admin\VerenigingController');


    //verantwoordelijkebeheer
    Route::get('qryVerantwoordelijke', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
    Route::resource('verantwoordelijke', 'Admin\VerantwoordelijkeController');
    Route::get('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');


    //vrijwilligers CRUD
    Route::get('qryVrijwilligers', 'Admin\VrijwilligerController@qryVrijwilligers');
    Route::resource('vrijwilligers', 'Admin\VrijwilligerController');

});
