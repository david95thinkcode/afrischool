<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@Home')->name('dashboard.home');
    Route::resource('etablissements', 'EtablissementController');
    Route::resource('professeurs', 'ProfesseurController');
    Route::resource('classe', 'ClasseController');
    Route::resource('matieres', 'MatiereController');
    Route::resource('enseigner', 'EnseignerController');

    // Personnel
    Route::prefix('personnel')->group(function () {
        Route::get('/', 'PersonnelController@index')->name('personnel.index');
        Route::get('create', 'PersonnelController@create')->name('personnel.create');
        Route::get('role', 'PersonnelController@createUserRole')->name('personnel.role.create');
        
        Route::post('create', 'PersonnelController@store')->name('personnel.store');
        Route::post('role', 'PersonnelController@addRoletoUser')->name('personnel.role.store');
    });

    //Les absences
    Route::prefix('absences')->group(function () {
        Route::get('/', 'AbsenceController@index')->name('absences.index');
        Route::get('search', 'AbsenceController@search')->name('absences.search');
        Route::get('ajouter', 'AbsenceController@selectDateAndClasse')->name('absences.steps.first');
        
        Route::post('/', 'AbsenceController@show')->name('absences.show');
        Route::post('ajouter', 'AbsenceController@store')->name('absences.store');
        Route::post('ajouter/mat', 'AbsenceController@selectMatiere')->name('absences.steps.second');
        Route::post('ajouter/el', 'AbsenceController@selectAbsence')->name('absences.steps.last');

    });

    // bulletins
    Route::prefix('bulletins')->group(function () {
        Route::get('/', 'BulletinController@index')->name('bulletin.index');
        Route::get('{niveau}/', 'BulletinController@SelectCriteres')
            ->where('niveau', '[A-Za-z]+')
            ->name('bulletin.criteres.get');
        Route::post('/', 'BulletinController@ListEleves')
            ->where('niveau', '[A-Za-z]+')
            ->name('bulletin.criteres.post');
        Route::get('trimestre/{idtrimestre}/{matricule}', 'BulletinController@AvgByTrimestreWithRangeAndNumber')
            ->where('idtrimestre', '[0-9]')
            ->where('matricule', '[0-9]+')
            ->name('bulletin.showbytrimestre');
        Route::get('final/{matricule}', 'BulletinController@FinalAvgWithRangeAndNumber')
            ->where('matricule', '[0-9]+')
            ->name('bulletin.final');
    });
    // classe
    Route::get('classe/liste/{niveau}', 'ClasseController@listclasse')
        ->where('niveau', '[A-Za-z]+')
        ->name('classe.list');

    //update eleve
    Route::get('informations/parent-eleve/{id}', 'InscriptionController@indexInfoParent')->where('id', '[0-9]+')->name('parent.info');
    Route::put('informations/parent-eleve/{id}', 'InscriptionController@updateInfoParent')->name('parent.update');

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
        Route::get('classes/{classe}', 'InscriptionController@showForClasse')->name('inscriptions.classe.show');
        Route::post('/', 'InscriptionController@searchForClasse');
    });
    Route::post('creer-annee-scolaire', 'EnseignerController@createAnneeScolaire')->name('anneescolaire.store');
    // Notes
    Route::prefix('notes')->group(function () {
        Route::post('last-step', 'MatiereController@searchForClasse')->name('notes.store.last-step');
        Route::get('classes', 'NoteController@indexClass')->name('note.byclass');
        Route::get('selection-classe', 'NoteController@selectType')->name('notes.selecteType');
        Route::get('classe/{niveau}', 'NoteController@selectNiveau')->where('niveau', '[A-Za-z]+')->name('notes.create');
        Route::post('second-step', 'NoteController@goToSecondStep')->name('notes.classe.second');
        Route::post('fird-step', 'NoteController@lastStep')->name('notes.classe.fird');
        Route::post('save', 'NoteController@store')->name('notes.req');
        Route::get('add-ligne-eleve/{eleve}', 'NoteController@createNewLigne')->name('add.ligne.eleve');
        Route::get('reload-table', 'NoteController@reload')->name('reload.note');
    });
    //gestion scolarité
    route::prefix('scolarite')->group(function(){
        route::get('/', 'EleveController@listeInsolder')->name('eleve.reste.versement');
        route::get('paiement-scolarite/{inscrit}/{eleve}', 'EleveController@indexsolderScolarite')->name('eleve.solder.scolarite');
        route::post('paiement-scolarite', 'EleveController@solderScolarite')->where('inscrit', '[0-9]+')->name('eleve.solder');
    });
    //Matiere
    Route::prefix('matiere')->group(function () {
        Route::prefix('classes')->group(function () {
            Route::get('/', 'MatiereController@showAllWithClasse')->name('matiere.show.classes');
            Route::get('/{classe}', 'MatiereController@showForSpecificClasse')
                ->where('classe', '[0-9]+')->name('matiere.show.classe');
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
        Route::get('professeur/{id}/edit', 'ProfesseurController@edit')
            ->name('professeur.edit');
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
    //Finance
    Route::prefix('finance')->group(function(){
        Route::get('informations-generales', 'ComptabiliteController@index')->name('finance.index');
        Route::get('saisir-depenses', 'ComptabiliteController@indexDepenses')->name('finance.depense.index');
        Route::post('save-depenses', 'ComptabiliteController@storeDepenses')->name('finance.depense.save');
        Route::get('information-dépenses', 'ComptabiliteController@showDepense')->name('finance.depense.show');
        Route::post('periode-depenses', 'ComptabiliteController@periodeDepense')->name('finance.depense.periode');
    });
});