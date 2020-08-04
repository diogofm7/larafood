<?php

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

Route::group([
    'prefix' => 'admin',
    'namespace' => 'admin',
    'as' => 'admin.'
], function () {

    /**
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('index');


    /**
     * Routes Permission x Profile
     */
    Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionProfileController@permissionsDetach')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions/attach', 'ACL\PermissionProfileController@permissionsAttach')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::any('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::any('permissions/{idPermission}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('Permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');

    /**
     * Routes Profiles
     */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Routes Details Plans
     */
    Route::group([
        'prefix' => 'plan',
        'as' => 'details.plan.'
    ], function () {
        Route::delete('/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('destroy');
        Route::get('/{url}/details/{idDetail}', 'DetailPlanController@show')->name('show');
        Route::put('/{url}/details/{idDetail}', 'DetailPlanController@update')->name('update');
        Route::get('/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('edit');
        Route::post('/{url}/details', 'DetailPlanController@store')->name('store');
        Route::get('/{url}/details/create', 'DetailPlanController@create')->name('create');
        Route::get('/{url}/details', 'DetailPlanController@index')->name('index');
    });

    /**
     * Routes Plans
     */
    Route::group([
        'prefix' => 'plans',
        'as' => 'plans.'
    ], function () {
        Route::any('search', 'PlanController@search')->name('search');
        Route::post('/', 'PlanController@store')->name('store');
        Route::get('create', 'PlanController@create')->name('create');
        Route::get('/', 'PlanController@index')->name('index');
        Route::put('/{url}', 'PlanController@update')->name('update');
        Route::get('/{url}/edit', 'PlanController@edit')->name('edit');
        Route::delete('/{url}', 'PlanController@destroy')->name('destroy');
        Route::get('/{url}', 'PlanController@show')->name('show');
    });

});


Route::get('/', function () {
    return view('welcome');
});

/*Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');*/
