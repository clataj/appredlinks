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
    Route::get('users/{user}/show', 'UserController@show')->name('users.show');
    Route::put('users/{user}', 'UserController@update')->name('users.update');
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
    Route::get('users/all', 'UserController@findAll')->name('users.data');

    // Categories

    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::get('categories/{category}/show', 'CategoryController@show')->name('categories.show');
    Route::put('categories/{category}', 'CategoryController@update')->name('categories.update');
    Route::post('categories/{category}/image', 'CategoryController@updateImage')->name('categories.updateImage');
    Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.destroy');
    Route::get('categories/all', 'CategoryController@findAll')->name('categories.data');

    // Empresas
    Route::get('enterprises', 'EnterpriseController@index')->name('enterprises.index');
    Route::post('enterprises', 'EnterpriseController@store')->name('enterprises.store');
    Route::get('enterprises/{enterprise}/show', 'EnterpriseController@show')->name('enterprises.show');
    Route::put('enterprises/{enterprise}', 'EnterpriseController@update')->name('enterprises.update');
    Route::post('enterprises/{enterprise}/image/background', 'EnterpriseController@updateImageBackground')->name('enterprises.updateImageBackground');
    Route::post('enterprises/{enterprise}/image/content', 'EnterpriseController@updateImageContent')->name('enterprises.updateImageContent');
    Route::delete('enterprises/{enterprise}', 'EnterpriseController@destroy')->name('enterprise.destroy');
    Route::get('enterprises/all', 'EnterpriseController@findAll')->name('enterprises.data');
    Route::get('enterprises/{enterprise}/branch-office', 'BranchOfficeController@showViewOfBranchOfficeByEnterprises')->name('branchOffices.createBranchOffice');
    Route::get('enterprises/{enterprise}/branch-offices', 'BranchOfficeController@findAllBranchOfficeByEnterprise')->name('branchOffices.data');

    // Sucursales
    Route::get('branchOffices/{branchOffice}', 'BranchOfficeController@show')->name('branchOffices.show');
    Route::put('branchOffices/{branchOffice}', 'BranchOfficeController@update')->name('branchOffices.update');
    Route::delete('branchOffices/{branchOffice}', 'BranchOfficeController@destroy')->name('branchOffices.destroy');
    Route::post('branchOffices', 'BranchOfficeController@store')->name('branchOffices.store');

    // Publicidades
    Route::get('publicities', 'PublicityController@index')->name('publicities.index');
    Route::get('publicities/{publicity}/show', 'PublicityController@show')->name('publicities.show');
    Route::post('publicities/{publicity}/image', 'PublicityController@updateImage')->name('enterprises.updateImage');
    Route::put('publicities/{publicity}', 'PublicityController@update')->name('enterprises.update');
    Route::delete('publicities/{publicity}', 'PublicityController@destroy')->name('enterprises.destroy');
    Route::post('publicities', 'PublicityController@store')->name('publicities.store');
    Route::get('publicities/enterprises', 'PublicityController@searchEnterprise')->name('publicities.enterprises');
    Route::get('publicities/all', 'PublicityController@findAll')->name('publicities.data');

    // Cupones
    Route::get('coupons', 'CouponController@index')->name('coupons.index');
    Route::post('coupons', 'CouponController@store')->name('coupons.store');
    Route::put('coupons/{coupon}', 'CouponController@update')->name('coupons.update');
    Route::put('coupons/{coupon}/disabled', 'CouponController@disabled')->name('coupons.disabled');
    Route::put('coupons/{coupon}/enabled', 'CouponController@enabled')->name('coupons.enabled');
    Route::get('coupons/{coupon}/show', 'CouponController@show')->name('coupons.show');
    Route::get('coupons/all', 'CouponController@findAll')->name('coupons.data');
});
