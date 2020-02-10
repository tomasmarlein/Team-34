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


Route::view('/aanvraag', 'aanvragen.aanvraag');
Route::view('/aanvraagverantwoordelijke', 'aanvragen.aanvraagverantwoordelijke');
Route::view('/documentatie', 'Documentatie');


Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'landingpage');


Route::get('verenigingAanvragen','Admin\VerenigingController@verenigingAanvragen');
Route::get('verenigingAanvragenNext','Admin\VerenigingController@verenigingAanvragenNext');
Route::view('aanvragen.bevestiging', 'bevestiging');




Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/home', 'Admin\AdminpaneelController@index');

    //aangevraagde verenigingen
    Route::view('/inaanvraag', 'admin.verenigingen.inaanvraag');
    Route::get('qryVerenigingenInAanvraag','Admin\VerenigingController@qryVerenigingenInAanvraag');
    Route::get('approve/{id}','Admin\VerenigingController@approve');

});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    //evenementen
    Route::get('qryEvenementen','Admin\EvenementController@qryEvenementen');
    Route::resource('evenementen', 'Admin\EvenementController');

    //vereniginen
    Route::get('qryVerenigingen','Admin\VerenigingController@qryVerenigingen');
    Route::get('getAllVerenigingen','Admin\VerenigingController@getAllVerenigingen');
    Route::resource('verenigingen', 'Admin\VerenigingController');
    Route::get('active/{id}','Admin\VerenigingController@active');
    Route::get('nonactive/{id}','Admin\VerenigingController@nonactive');


    //verantwoordelijkebeheer

//    route verantwoordelijke
    Route::get('qryVerantwoordelijke', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
    Route::resource('verantwoordelijke', 'Admin\VerantwoordelijkeController');
    Route::get('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');


    //vrijwilligers CRUD
    Route::get('qryVrijwilligers', 'Admin\VrijwilligerController@qryVrijwilligers');
    Route::resource('vrijwilligers', 'Admin\VrijwilligerController');

    //kernleden CRUD
    Route::get('qryKernleden', 'Admin\KernledenController@qryKernleden');
    Route::resource('kernleden', 'Admin\KernledenController');

    //aanvraag
    Route::get('verenigingAanvragen','Admin\VerenigingController@verenigingAanvragen');


});

