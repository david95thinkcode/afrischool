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
    Route::get('/', 'DashboardController@Home')->name('dashboard.home');
    Route::resource('etablissements', 'EtablissementController');
    Route::resource('professeurs', 'ProfesseurController');
    Route::resource('classe', 'ClasseController');
    Route::resource('matieres', 'MatiereController');
    
    /**
     * Matiere
     */
    Route::prefix('matiere')->group(function() {

        /**
         * Classes
         */
        Route::prefix('classes')->group(function() {

            Route::get('/', 'MatiereController@showAllWithClasse')
                ->name('matiere.show.classes');

            Route::get('/{classe}', 'MatiereController@showForSpecificClasse')
                ->where('classe', '[0-9]+')
                ->name('matiere.show.classe');

            Route::post('/', 'MatiereController@searchForClasse')
                ->where('classe', '[0-9]+');
        });
        
    });

    Route::resource('enseigner', 'EnseignerController');

    //Route::resource('Noe')
});