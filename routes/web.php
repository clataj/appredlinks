<?php

use App\Http\Controllers\UserController;
use App\User;
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
    // Settings
    Route::get('/settings', 'ProfileController@index')->name('settings');
    Route::post('profile/{user}/credentials', 'ProfileController@updateCredentials')->name('profile.updateCredentials');
    Route::put('profile/{user}', 'ProfileController@update')->name('profile.update');

    // Empresa
    Route::get('enterprises/{enterprise}/benefit', 'BenefitController@showViewOfBenefitByEnterprises')->name('benefits.create');
    Route::get('enterprises/{enterprise}/benefits', 'BenefitController@findAllBenefitsByEnterprise')->name('benefits.data');
    Route::get('enterprises/{enterprise}/show', 'EnterpriseController@show')->name('enterprises.show');
    Route::post('enterprises/{enterprise}/image/background', 'EnterpriseController@updateImageBackground')->name('enterprises.updateImageBackground');
    Route::post('enterprises/{enterprise}/image/content', 'EnterpriseController@updateImageContent')->name('enterprises.updateImageContent');

    // Sucursales
    Route::get('branchOffices/{branchOffice}', 'BranchOfficeController@show')->name('branchOffices.show');
    Route::put('branchOffices/{branchOffice}', 'BranchOfficeController@update')->name('branchOffices.update');
    Route::delete('branchOffices/{branchOffice}', 'BranchOfficeController@destroy')->name('branchOffices.destroy');
    Route::post('branchOffices', 'BranchOfficeController@store')->name('branchOffices.store');

    // Beneficios
    /*
    Route::post('benefits', 'BenefitController@store')->name('benefits.store');
    Route::get('benefits/{benefit}', 'BenefitController@show')->name('benefits.show');
    Route::put('benefits/{benefit}', 'BenefitController@update')->name('benefits.update');
    Route::delete('benefits/{benefit}', 'BenefitController@destroy')->name('benefits.destroy');
    */

    // Cupones
    Route::post('coupons', 'CouponController@store')->name('coupons.store');
    Route::put('coupons/{coupon}', 'CouponController@update')->name('coupons.update');
    Route::get('coupons/{coupon}/show', 'CouponController@show')->name('coupons.show');


    // Publicidades
    Route::get('publicities/{publicity}/show', 'PublicityController@show')->name('publicities.show');
    Route::post('publicities/{publicity}/image', 'PublicityController@updateImage')->name('publicities.updateImage');
    Route::put('publicities/{publicity}', 'PublicityController@update')->name('publicities.update');
    Route::delete('publicities/{publicity}', 'PublicityController@destroy')->name('publicities.destroy');

});

Route::middleware(['auth', 'administrator'])->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    // Users
    Route::post('users', 'Administrador\UserController@store')->name('users.store');
    Route::get('users/create', 'Administrador\UserController@create')->name('users.create');
    Route::get('users/{user}/edit', 'Administrador\UserController@edit')->name('users.edit');
    Route::put('users/{user}', 'Administrador\UserController@update')->name('users.update');
    Route::delete('users/{user}', 'Administrador\UserController@destroy')->name('users.destroy');
    Route::get('users/all', 'Administrador\UserController@findAll')->name('users.data');

    // Categories
    Route::get('categories', 'Administrador\CategoryController@index')->name('categories.index');
    Route::post('categories', 'Administrador\CategoryController@store')->name('categories.store');
    Route::get('categories/{category}/show', 'Administrador\CategoryController@show')->name('categories.show');
    Route::put('categories/{category}', 'Administrador\CategoryController@update')->name('categories.update');
    Route::post('categories/{category}/image', 'Administrador\CategoryController@updateImage')->name('categories.updateImage');
    Route::delete('categories/{category}', 'Administrador\CategoryController@destroy')->name('categories.destroy');
    Route::get('categories/all', 'Administrador\CategoryController@findAll')->name('categories.data');

    // Empresas
    Route::get('enterprises', 'Administrador\EnterpriseController@index')->name('enterprises.index');
    Route::get('enterprises/all', 'Administrador\EnterpriseController@findAll')->name('enterprises.data');
    Route::post('enterprises', 'Administrador\EnterpriseController@store')->name('enterprises.store');
    Route::put('enterprises/{enterprise}', 'Administrador\EnterpriseController@update')->name('enterprises.update');
    Route::delete('enterprises/{enterprise}', 'Administrador\EnterpriseController@destroy')->name('enterprise.destroy');
    Route::get('enterprises/search', 'Administrador\EnterpriseController@searchEnterprise')->name('enterprises.search');
    Route::get('enterprises/{enterprise}/branch-office', 'Administrador\BranchOfficeController@showViewOfBranchOfficeByEnterprises')->name('branchOffices.createBranchOffice');
    Route::get('enterprises/{enterprise}/branch-offices', 'Administrador\BranchOfficeController@findAllBranchOfficeByEnterprise')->name('branchOffices.data');


    // Publicidades
    Route::get('publicities', 'Administrador\PublicityController@index')->name('publicities.index');
    Route::get('publicities/enterprises', 'Administrador\PublicityController@searchEnterprise')->name('publicities.enterprises');
    Route::get('publicities/all', 'Administrador\PublicityController@findAll')->name('publicities.data');

    // Cupones
    Route::get('coupons', 'Administrador\CouponController@index')->name('coupons.index');
    Route::get('coupons/all', 'Administrador\CouponController@findAll')->name('coupons.data');
    Route::put('coupons/{coupon}/disabled', 'Administrador\CouponController@disabled')->name('coupons.disabled');
    Route::put('coupons/{coupon}/enabled', 'Administrador\CouponController@enabled')->name('coupons.enabled');

});

Route::middleware(['auth', 'enterprise'])->group(function () {
    // Empresas
    Route::get('my/{user}/enterprises', 'Empresa\EnterpriseController@index')->name('users.enterprises.index');
    Route::get('my/{user}/enterprises/all', 'Empresa\EnterpriseController@findAll')->name('users.enterprises.data');
    Route::get('my/enterprises/{enterprise}/branch-office', 'Empresa\BranchOfficeController@showViewOfBranchOfficeByEnterprises')->name('users.branchOffices.createBranchOffice');
    Route::get('my/enterprises/{enterprise}/branch-offices', 'Empresa\BranchOfficeController@findAllBranchOfficeByEnterprise')->name('users.branchOffices.data');
    Route::post('my/enterprises', 'Empresa\EnterpriseController@store')->name('users.enterprises.store');
    Route::put('my/enterprises/{enterprise}', 'Empresa\EnterpriseController@update')->name('users.enterprises.update');


    // Publicidades
    Route::get('my/{user}/publicities', 'Empresa\PublicityController@index')->name('publicities.enterprise.index');
    Route::get('my/{user}/publicities/all', 'Empresa\PublicityController@findAll')->name('publicities.enterprise.data');
    Route::post('my/publicities', 'Empresa\PublicityController@store')->name('publicities.enterprise.store');
    Route::put('my/publicities/{publicity}', 'Empresa\PublicityController@update')->name('enterprises.enterprise.update');

    // Cupones
    Route::get('my/coupons/{enterprise}/all', 'Empresa\CouponController@findAll')->name('coupons.dataEnterprise');
    Route::get('my/coupons/{enterprise}/create', 'Empresa\CouponController@create')->name('coupons.create');
});
