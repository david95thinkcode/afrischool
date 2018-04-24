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
    Route::resource('notes', 'NoteController');

    /**
     * Notes
     */
    Route::prefix('notes')->group(function () {
        
        Route::post('last-step', 'MatiereController@searchForClasse')
            ->name('notes.store.last-step');
    });

    /**
     * Matiere
     */
    Route::prefix('matiere')->group(function () {

        // Classes
        Route::prefix('classes')->group(function () {

            Route::get('/', 'MatiereController@showAllWithClasse')
                ->name('matiere.show.classes');

            Route::get('/{classe}', 'MatiereController@showForSpecificClasse')
                ->where('classe', '[0-9]+')
                ->name('matiere.show.classe');

            Route::post('/', 'MatiereController@searchForClasse');
        });

    });

    // Professeurs
    Route::prefix('professeur/')->group(function () {
        Route::get('tous', 'ProfesseurController@listAll')
            ->name('professeurs.list');
        Route::post('par-classe', 'ProfesseurController@list')
            ->name('classe.professeurs.list');

        Route::resource('diplomes', 'DiplomeController');
        Route::get('{professeur}/diplome/create', 'DiplomeController@createFromProf')
            ->where('professeur', '[0-9]+')
            ->name('professeur.diplome.create');
    });

    Route::prefix('inscription-eleve')->group(function () {
        Route::get('/{type}', 'EleveController@create')->name('eleves.create');
    });

    Route::prefix('inscriptions-enregistres')->group(function () {

        Route::get('/classes/{classe}', 'InscriptionController@showForClasse')
            ->name('inscriptions.classe.show');

        Route::post('/', 'InscriptionController@searchForClasse');
    });

    // Activation
    Route::prefix('activate')->group(function () {
        Route::get('etablissement/{etablissement}', 'EtablissementController@activate')
            ->where('etablissement', '[0-9]+')
            ->name('etablissements.activate');
    });

    /*users*/
    Route::prefix('users')->group(function(){
        Route::get('users', 'UserController@index')->name('users');
        Route::get('users/{user}', 'UserController@show')->name('users.show');
        Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('users/{user}', 'UserController@update')->name('users.update');
    });
});

/*
* Utilisée par les requêtes ajax
*/
Route::prefix('ajax')->group(function () {
    Route::get('pays', 'PublicResourcesController@getPays');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.req');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@create')->name('register.req');

// Password Reset Routes...
Route::get('reinitialiser-mot-de-passe', 'Auth\ResetPasswordController@index')->name('password.request');
Route::post('reinitialiser-mot-de-passe', 'Auth\ResetPasswordController@resetPassword')->name('password.tel');
Route::post('reinitialisation-mot-de-passe', 'Auth\ResetPasswordController@requestPassword')->name('password.requeste');

//Auth::routes();