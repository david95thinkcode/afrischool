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

Route::get('/', function () {
    return view('public.home');
});

Route::resource('inscriptions', 'InscriptionController');

Route::prefix('dashboard')->group(function () {
    Route::get('/', 'DashboardController@Home');
    Route::resource('etablissements', 'EtablissementController');
    Route::resource('classe', 'ClasseController');
    //Route::resource('Noe')
});