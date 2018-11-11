<?php

//Notification system
Route::get('liste-classe', 'NotificationController@getClasse');
Route::get('list-parent/{id}', 'NotificationController@getParent')->where('id', '[0-9]+');
Route::post('send-message-parent', 'NotificationController@sendNotification');

Route::get('classes/fetch', 'ClasseController@fetch');

Route::prefix('emploi-du-temps')->group(function () {
    Route::get('p/{professeur}', 'EmploiDuTempsController@getForProfesseur');
    Route::get('c/{classe}', 'EmploiDuTempsController@getForClasse');
    
    Route::post('day', 'EmploiDuTempsController@getForDay');
});

Route::post('absences/store', 'AbsenceController@storeFromJsPost');
Route::post('comptabilite/scolarite/state', 'GestionScolarite\ScolariteController@getScolariteState');

Route::prefix('enseigner')->group(function () {
    Route::get('{enseigner}', 'EnseignerController@show');
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

