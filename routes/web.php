<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Enseignant\PrintController;
use App\Http\Controllers\Enseignant\HomeController;
use App\Http\Controllers\Enseignant\NoteController;
use App\Http\Controllers\Enseignant\ProfileController;
use App\Http\Controllers\Enseignant\Auth\LoginController;
use App\Http\Controllers\Enseignant\Auth\ResetPasswordController;
use App\Http\Controllers\Enseignant\Auth\ForgotPasswordController;
use App\Http\Controllers\Enseignant\Auth\ConfirmPasswordController;
use App\Http\Controllers\Enseignant\MissingController;

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

// Enseignant Routes
Route::prefix('/master')->name('master.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
    Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    
    Route::middleware('auth:web')->group(function () {
        // Home for master
        Route::get('/', [HomeController::class ,'home'])->name('index');

        // Gestion de l'impression
        Route::prefix('/print')->group(function(){
            Route::get('/classe/{id}', [PrintController::class, 'classe'])->name('print.classe');
        });

        // Gestion des notes
        Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
        Route::get('/notes/{student}', [NoteController::class, 'show'])->name('notes.show');
        Route::patch('/notes/{note}/store', [NoteController::class, 'store'])->name('notes.store');

        // Routes for profile manager
        Route::get('/profile', [ProfileController::class ,'index'])->name('profile');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
        
        // Gestion d'absence
        Route::prefix('/missing')->group(function() {
            Route::get('/', [MissingController::class, 'index'])->name('missings.index');
            Route::get('/create', [MissingController::class, 'create'])->name('missings.create');
            Route::post('/mark', [MissingController::class, 'mark'])->name('missings.mark');
            Route::get('/list', [MissingController::class, 'list'])->name('missings.list');
            Route::get('/list/{missing}/show', [MissingController::class, 'show'])->name('missings.list.show');
        });
    });
});

// Admin routes
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->name('admin.')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('/password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', 'HomeController@home')->name('index');

        // Gestion de l'impression
        Route::prefix('/print')->group(function(){
            Route::get('/classe/{id}', 'PrintController@classe')->name('print.classe');
            Route::get('/master', 'PrintController@master')->name('print.master');
        });

        // Gestion des classes
        Route::prefix('/classes')->name('classes.')->group(function() {
            Route::get('/{classe}', 'ClasseController@show')->name('show');
            
            // Gestion d'absence
            Route::group(['prefix' => '{classe}/missing'], function() {
                Route::get('/', 'MissingController@index')->name('missings.index');
                Route::get('/{missing}/list', 'MissingController@list')->name('missings.list');
                Route::post('/mark', 'MissingController@mark')->name('missings.mark');
                Route::delete('/delete', 'MissingController@delete')->name('missings.delete');
            });
            
            // Gestion des notes
            Route::group(['prefix' => '{classe}/notes'], function() {
                Route::get('/', 'NoteController@index')->name('notes.index');
                Route::get('/{student}/bulletin', 'NoteController@show')->name('notes.show');
            });
        });
        
        // Gestion des eleves
        // Route::get('/students/{student}/notes', 'NoteStudentController@index');
        Route::resource('/students', 'StudentController')->only(['index', 'destroy','edit','update','store']);
        
        // Gestion des matieres
        Route::prefix('/activities')->name('activities.')->group(function(){
            Route::post('/store', 'ActivityController@store')->name('store');
            Route::delete('/{activity}/destroy', 'ActivityController@destroy')->name('destroy');
        });

        // Gestion des domaines
        Route::prefix('/domains')->name('domains.')->group(function () {
            Route::get('/', 'DomainController@index')->name('index');
            Route::post('/', 'DomainController@store')->name('store');
            Route::patch('/{domain}/update', 'DomainController@update')->name('update');
            Route::delete('/{domain}/destroy', 'DomainController@destroy')->name('destroy');
        });

        // Gestion des sous domaines
        Route::prefix('/subdomains')->name('subdomains.')->group(function () {
            Route::post('/', 'SubDomainController@store')->name('store');
            Route::delete('/{subdomain}/destroy', 'SubDomainController@destroy')->name('destroy');
        });

        // Gestion des programmes et niveaux
        Route::prefix('/programs')->name('programs.')->group(function() {
            // Gestion des classes
            Route::post('/classes', 'ClasseController@store')->name('classes.store');
            Route::put('/classes/{id}/update', 'ClasseController@update')->name('classes.update');
            Route::delete('/classes/{id}/destroy', 'ClasseController@destroy')->name('classes.destroy');
            // Gestion des niveaux d'etude
            Route::post('/niveaux', 'NiveauController@store')->name('niveaux.store');

            // Gestion des programme
            Route::get('/', 'ProgramController@index')->name('index');
            Route::post('/', 'ProgramController@store')->name('store');
            Route::patch('/{program}/update', 'ProgramController@update')->name('update');
            Route::delete('/{program}/destroy', 'ProgramController@destroy')->name('destroy');
        });
        
        // Gestion des enseignants
        Route::get('/enseignants', 'EnseignantController@index')->name('enseignants.index');
        Route::get('/enseignants/create', 'EnseignantController@create')->name('enseignants.create');
        Route::post('/enseignants/create', 'EnseignantController@store')->name('enseignants.store');
        Route::get('/enseignants/{user}/edit', 'EnseignantController@edit')->name('enseignants.edit');
        Route::put('/enseignants/{user}/update', 'EnseignantController@update')->name('enseignants.update');
        
        // Historiques
        Route::get('/histories', 'HistoryController@index')->name('histories.index');
        Route::post('/histories/', 'HistoryController@getDataForApi');

        // Permission aux role de super admin
        Route::middleware('isAdmin')->group(function (){
            // Gestion des utilisateurs administrateurs
            Route::get('/users', 'UserController@index')->name('users.index');
            Route::get('/users/create', 'UserController@create')->name('users.create');
            Route::post('/users/store', 'UserController@store')->name('users.store');
            Route::get('/users/{admin}/edit', 'UserController@edit')->name('users.edit');
            Route::put('/users/{admin}/update', 'UserController@update')->name('users.update');
            Route::delete('/users/{admin}/destroy', 'UserController@destroy')->name('users.destroy');
            Route::get('/users/{admin}/toggle', 'UserController@toggleActive')->name('users.toggleActive');
        });

        // Gestion du compte profile
        Route::get('/profile', 'ProfileController@profile')->name('profile');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
        Route::put('/profile/password', 'ProfileController@password')->name('profile.password');
    });

});


// Route for welcome page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
