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


use App\Http\Middleware\Admin;
use App\Http\Middleware\Verantwoordelijke;

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');


Route::view('/aanvraag', 'aanvragen.aanvraagverantwoordelijke');
Route::view('/aanvraagverantwoordelijke', 'aanvragen.aanvraagverantwoordelijke');
Route::view('/documentatie', 'Documentatie');


Route::get('/home', 'HomeController@index')->name('home');
Route::view('/', 'landingpage');


Route::get('verenigingAanvragen','Admin\VerenigingController@verenigingAanvragen');
Route::get('verenigingAanvragenNext','Admin\VerenigingController@verenigingAanvragenNext');
Route::get('aanvraagBevestigen','Admin\VerenigingController@aanvraagBevestigen');
Route::get('aanvraagVoltooid','Admin\VerenigingController@aanvraagVoltooid');
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

    //import en export vrijwilliger
    Route::get('download','Admin\VrijwilligerController@export');
    Route::get('downloadTemplate','Admin\VrijwilligerController@downloadTemplate');
    Route::post('import', 'Admin\VrijwilligerController@import')->name('import');

    //vereniginen
    Route::get('qryVerenigingen','Admin\VerenigingController@qryVerenigingen');
    Route::get('getHoofd','Admin\VerenigingController@getVerant');
    Route::get('getAllVerenigingen','Admin\VerenigingController@getAllVerenigingen');
    Route::resource('verenigingen', 'Admin\VerenigingController');
    Route::get('active/{id}','Admin\VerenigingController@active');
    Route::get('nonactive/{id}','Admin\VerenigingController@nonactive');

//route Tshirt
    Route::get('qryTshirt','Admin\TshirtController@qryTshirt');
    Route::get('qryTshirtTypes','Admin\TshirtController@qryTshirtTypes');
    Route::resource('tshirt', 'Admin\TshirtController');
    Route::get('tshirt', 'Admin\TshirtController@index');

    //route Lunchpakket
    Route::resource('Lunchpakket', 'Admin\LunchpakketController');
    Route::get('Lunchpakket', 'Admin\LunchpakketController@index');

    //route Tijdsregistratie
    Route::resource('tijdsregistratie', 'Admin\TijdsregistratieController');
    Route::get('Tijdsregistratie', 'Admin\TijdsregistratieController@index');
    Route::get('downloadTijd','Admin\TijdsregistratieController@export');


//   route verantwoordelijke
    Route::get('qryVerantwoordelijke', 'Admin\VerantwoordelijkeController@qryVerantwoordelijke');
    Route::resource('verantwoordelijke', 'Admin\VerantwoordelijkeController');
    Route::get('verantwoordelijke', 'Admin\VerantwoordelijkeController@index');


    //vrijwilligers CRUD
    Route::get('qryVrijwilligers', 'Admin\VrijwilligerController@qryVrijwilligers');
    Route::resource('vrijwilligers', 'Admin\VrijwilligerController');
    Route::get('qryGetAllVerenigingen', 'Admin\VrijwilligerController@qryGetAllVerenigingen');

    //kernleden CRUD
    Route::get('qryKernleden', 'Admin\KernledenController@qryKernleden');
    Route::resource('kernleden', 'Admin\KernledenController');

    //aanvraag
    Route::get('verenigingAanvragen','Admin\VerenigingController@verenigingAanvragen');
});




Route::middleware(['auth', 'verantwoordelijke'])->group(function () {

    Route::view('/verant', 'verantwoordelijke.vereniging');

    Route::get('qryLeden', 'Verantwoordelijke\VerenigingController@qryLeden');



});

Route::middleware(['auth', 'verantwoordelijke'])->prefix('verantwoordelijke')->group(function () {

    Route::get('qryVerenigingen', 'Verantwoordelijke\VerenigingController@qryVerenigingen');
    Route::get('getVereniging', 'Verantwoordelijke\VerenigingController@getVereniging');
    Route::get('showLeden/{id}', 'Verantwoordelijke\VerenigingController@showLeden');
    Route::get('aanvraagVoltooid','Admin\VerenigingController@aanvraagVoltooid');




    Route::resource('verenigingen', 'Verantwoordelijke\VerenigingController');
    Route::get('verenigingen', 'Verantwoordelijke\VerenigingController@index');
});

//update profile & ww aanpassen
Route::redirect('user', '/shared/profile');
Route::middleware(['auth'])->prefix('user')->group(function () {
    //profile
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    //password
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
});
