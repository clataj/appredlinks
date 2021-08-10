<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::middleware(['guest'])->group(function () {
    Route::get('/', 'Auth\LoginController@formLogin')->name('home');
	Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    // Users
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users/{user}/edit', 'UserController@show')->name('users.show');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
    Route::get('users/all', 'UserController@findAll')->name('users.data');

    // Categories

    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::get('categories/{category}/edit', 'CategoryController@show')->name('categories.show');
    Route::put('categories/{category}', 'CategoryController@update')->name('categories.update');
    Route::post('categories/{category}/image', 'CategoryController@updateImage')->name('categories.updateImage');
    Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.destroy');
    Route::get('categories/all', 'CategoryController@findAll')->name('categories.data');

    // Empresas
    Route::get('enterprises', 'EnterpriseController@index')->name('enterprises.index');
    Route::post('enterprises', 'EnterpriseController@store')->name('enterprises.store');
    Route::get('enterprises/{enterprise}/edit', 'EnterpriseController@show')->name('enterprises.show');
    Route::put('enterprises/{enterprise}', 'EnterpriseController@update')->name('enterprises.update');
    Route::post('enterprises/{enterprise}/image/background', 'EnterpriseController@updateImageBackground')->name('enterprises.updateImageBackground');
    Route::post('enterprises/{enterprise}/image/content', 'EnterpriseController@updateImageContent')->name('enterprises.updateImageContent');
    Route::get('enterprises/all', 'EnterpriseController@findAll')->name('enterprises.data');

});
