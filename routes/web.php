<?php

use App\Http\Controllers\Enseignant\HomeController;
use App\Http\Controllers\Enseignant\Auth\LoginController;
use App\Http\Controllers\Enseignant\Auth\ResetPasswordController;
use App\Http\Controllers\Enseignant\Auth\ForgotPasswordController;
use App\Http\Controllers\Enseignant\Auth\ConfirmPasswordController;


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
Route::prefix('/enseignant')->name('enseignant.')->group(function () {
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
        Route::get('/', [HomeController::class ,'home'])->name('index');
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

        // Gestion des eleves
        Route::resource('/students', 'StudentController')->only(['destroy','edit','update','store']);

        // Gestion des classes
        Route::get('/classes/{classe}', 'ClasseController@show')->name('classes.show');
        
        // Gestion des enseignants
        Route::get('/enseignants', 'EnseignantController@index')->name('enseignants.index');
        
        // Gestion des utilisateurs administrateurs
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users/store', 'UserController@store')->name('users.store');
        Route::delete('/users/{admin}/destroy', 'UserController@destroy')->name('users.destroy');
        Route::get('/users/{admin}/toggle', 'UserController@toggleActive')->name('users.toggleActive');

        // Gestion du compte profile
        Route::get('/profile', 'ProfileController@profile')->name('profile');
        Route::put('/profile/update', 'ProfileController@update')->name('profile.update');
        Route::put('/profile/password', 'ProfileController@password')->name('profile.password');
    });

});


// Route for welcome page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
