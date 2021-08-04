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
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::post('users/create', 'UserController@store')->name('users.store');
    Route::get('users/{user}/edit', 'UserController@show')->name('users.show');
    Route::put('users/{user}/edit', 'UserController@update')->name('users.update');
    Route::delete('users/{user}/delete', 'UserController@destroy')->name('users.destroy');
    Route::get('users/all', 'UserController@findAll')->name('users.data');
});
