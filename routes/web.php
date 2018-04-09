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

Route::get('/', 'PublicPagesController@index')->name('home');

Route::prefix('dashboard')->group(function () {
    Route::get('/', 'DashboardController@Home')->name('dashboard.home');
    Route::resource('etablissements', 'EtablissementController');
    Route::resource('professeurs', 'ProfesseurController');
    Route::resource('niveaux', 'NiveauController');
    Route::resource('classe', 'ClasseController');
    Route::resource('matieres', 'MatiereController');
    Route::resource('enseigner', 'EnseignerController');
    Route::resource('inscriptions', 'InscriptionController');

    /**
     * Matiere
     */
    Route::prefix('matiere')->group(function() {

        // Classes
        Route::prefix('classes')->group(function() {

            Route::get('/', 'MatiereController@showAllWithClasse')
                ->name('matiere.show.classes');

            Route::get('/{classe}', 'MatiereController@showForSpecificClasse')
                ->where('classe', '[0-9]+')
                ->name('matiere.show.classe');

            Route::post('/', 'MatiereController@searchForClasse');
        });

    });

    Route::prefix('inscription-eleve')->group(function() {
      Route::get('/{type}', 'EleveController@create')->name('eleves.create');
    });

    Route::prefix('inscriptions-enregistres')->group(function() {

        Route::get('/classes/{classe}', 'InscriptionController@showForClasse')
            ->name('inscriptions.classe.show');

        Route::post('/', 'InscriptionController@searchForClasse');
    });
    
    // Activation
    Route::prefix('activate')->group(function() {
        Route::get('etablissement/{etablissement}', 'EtablissementController@activate')
                ->where('etablissement', '[0-9]+')
                ->name('etablissements.activate');
    });
});

    /*
    * Utilisée par les requêtes ajax
    */
    Route::prefix('ajax')->group(function () {
        Route::get('pays', 'PublicResourcesController@getPays');
    });
