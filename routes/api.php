<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('classes/fetch', 'ClasseController@fetch');
Route::get('emploi-du-temps/p/{professeur}', 'EmploiDuTempsController@getForProfesseur');
Route::get('emploi-du-temps/c/{classe}', 'EmploiDuTempsController@getForClasse');

Route::post('absences/store', 'AbsenceController@storeFromJsPost');
Route::post('comptabilite/scolarite/state', 'GestionScolarite\ScolariteController@getScolariteState');

Route::prefix('enseigner')->group(function () {
    Route::get('c/{classe}', 'EnseignerController@getForClasse');
    Route::post('cnd', 'EnseignerController@getForClasseAndDate');
});


Route::prefix('inscription')->group(function () {
    Route::prefix('c')->group(function () {
        Route::get('{classe}', 'InscriptionController@getForClasse');
        Route::get('basics/{classe}', 'InscriptionController@getBasicsForClasse');
        Route::get('full/{classe}', 'InscriptionController@getFullForClasse');
    });
});

