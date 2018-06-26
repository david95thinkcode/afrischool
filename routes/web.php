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
    //inscription
    Route::resource('inscriptions', 'InscriptionController');
    Route::get('inscription/parent-eleve', 'InscriptionController@indexParent')->name('eleve.parent.index');
    Route::post('inscription/parent-eleve', 'InscriptionController@sessionParent')->name('eleve.parent.create');
    Route::get('inscription/scolarite-eleve', 'InscriptionController@indexScolarite')->name('eleve.scolarite.index');
    Route::post('inscription/scolarite-eleve', 'InscriptionController@sessionScolarite')->name('eleve.scolarite.create');
    Route::get('reinscription/ancien/{id}', 'InscriptionController@indexAncien')->where('id', '[0-9]+')->name('reinscription.index');
    Route::post('reinsciption/paiement', 'InscriptionController@paiement')->name('reinscription.paiement');
    Route::prefix('inscription-eleve')->group(function () {
        Route::get('/{type}', 'EleveController@create')->name('eleves.create');
    });
    Route::prefix('inscriptions-enregistres')->group(function () {

        Route::get('classes/{classe}', 'InscriptionController@showForClasse')
            ->name('inscriptions.classe.show');

        Route::post('/', 'InscriptionController@searchForClasse');
    });
    //gestion des notes
    Route::get('notes/selection-classe', 'NoteController@create')->name('notes.create');
    Route::post('notes/second-step', 'NoteController@goToSecondStep')->name('notes.classe.second');
    Route::post('notes/fird-step', 'NoteController@lastStep')->name('notes.classe.fird');
    Route::post('notes/save', 'NoteController@store')->name('notes.req');
    // Notes
    Route::prefix('notes')->group(function () {
        Route::post('last-step', 'MatiereController@searchForClasse')
            ->name('notes.store.last-step');
    });
    //gestion scolarité
    route::prefix('scolarite')->group(function(){
        route::get('/', 'EleveController@listeInsolder')->name('eleve.reste.versement');
        route::get('paiement-scolarite/{inscrit}/{eleve}', 'EleveController@indexsolderScolarite')->name('eleve.solder.scolarite');
        route::post('paiement-scolarite', 'EleveController@solderScolarite')->where('inscrit', '[0-9]+')->name('eleve.solder');
    });
    //Matiere
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
    Route::prefix('professeur')->group(function () {
        Route::get('tous', 'ProfesseurController@listAll')
            ->name('professeurs.list');
        Route::post('par-classe', 'ProfesseurController@listProfesseur')
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

    // Emploi du temps
    Route::prefix('emploi-du-temps')->group(function () {
        Route::get('consulter', 'HoraireController@search')->name('emploi-du-temps.search');
        Route::get('{classe}', 'HoraireController@showAllForClasse')->where('classe', '[0-9]+')->name('emploi-du-temps.afficher');
        Route::get('create/horaire', 'HoraireController@create')->where('classe', '[0-9]+')->name('horaire.create');
        
        Route::post('consulter', 'HoraireController@showHoraires')->name('emploi-du-temps.search.go');
        Route::post('create/horaire', 'HoraireController@createSecondStep')->name('horaire.second-step.go');
        Route::post('create/horaire/store', 'HoraireController@store')->name('horaire.store');
        Route::delete('delete/horaire/{horaire}', 'HoraireController@destroy')->name('horaire.destroy');
    });

    // Activation
    Route::prefix('activate')->group(function () {
        Route::get('etablissement/{etablissement}', 'EtablissementController@activate')
            ->where('etablissement', '[0-9]+')->name('etablissements.activate');
    });

    /*users*/
    Route::prefix('users')->group(function(){
        Route::get('users', 'UserController@index')->name('users');
        Route::get('users/{user}', 'UserController@show')->name('users.show');
        Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
        Route::put('users/{user}', 'UserController@update')->name('users.update');
    });

    //Notifications
    Route::prefix('notification')->group(function(){
        Route::get('parents-eleves', 'NotificationController@indexForm')->name('notifier.user');
        Route::post('parents-eleves', 'NotificationController@sendNotification')->name('notifier.user.send');
        Route::get('notes-eleves', 'NotificationController@indexNotes')->name('notifier.notes');
        Route::post('notes-eleves', 'NotificationController@sendNotes')->name('notifier.notes.send');

    });
});

/**
 * Consultation des détails sur les enfants par les parents
 */
Route::prefix('consultation')->group(function(){
    Route::get('/', 'ConsultationController@choose')->name('consultation.choix');
    Route::get('enfant/{ideleve}', 'ConsultationController@home')->name('consultation.index');
    Route::get('enfant/{ideleve}/notes', 'ConsultationController@notes')->name('consultation.notes');
    Route::get('enfant/{ideleve}/absence', 'ConsultationController@absence')->name('consultation.absence');
    Route::get('enfant/{ideleve}/scolarite', 'ConsultationController@scolarite')->name('consultation.scolarite');
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
