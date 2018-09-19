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

/**
 * Consultation des détails sur les enfants par les parents
 */
Route::group(['prefix' => 'consultation', 'middleware' => ['auth']], function(){
    Route::get('/', 'ConsultationController@choose')->name('consultation.choix');
    Route::get('enfant/{ideleve}', 'ConsultationController@home')->name('consultation.index');
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
