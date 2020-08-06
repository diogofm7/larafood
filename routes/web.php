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
    'middleware' => [
        'auth'
    ],
    'as' => 'admin.'
], function () {

    /**
     * Home Dashboard
     */
    //Route::get('/', 'PlanController@index')->name('index');
    Route::get('/', function () {
        return redirect()->route('admin.plans.index');
    })->name('index');

    /**
     * Routes Plans x Profile
     */
    Route::get('profiles/{id}/plans/{idPlan}/detach', 'ACL\PlanProfileController@plansDetach')->name('profiles.plans.detach');
    Route::post('profiles/{id}/plans/attach', 'ACL\PlanProfileController@plansAttach')->name('profiles.plans.attach');
    Route::match(['get', 'post'],'profiles/{id}/plans/create', 'ACL\PlanProfileController@plansAvailable')->name('profiles.plans.available');
    Route::match(['get', 'post'],'profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');
    Route::match(['get', 'post'],'plans/{idPlan}/profile', 'ACL\PlanProfileController@profiles')->name('plans.profiles');

    /**
     * Routes Permission x Profile
     */
    Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionProfileController@permissionsDetach')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions/attach', 'ACL\PermissionProfileController@permissionsAttach')->name('profiles.permissions.attach');
    Route::match(['get', 'post'],'profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::match(['get', 'post'],'profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::match(['get', 'post'],'permissions/{idPermission}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

    /**
     * Routes Permissions
     */
    Route::match(['get', 'post'],'permissions/search', 'ACL\PermissionController@search')->name('Permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');

    /**
     * Routes Profiles
     */
    Route::match(['get', 'post'],'profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Routes Details Plans
     */
    Route::group([
        'prefix' => 'plan',
        'as' => 'details.plan.'
    ], function () {
        Route::delete('/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('destroy');
        Route::get('/{url}/details/create', 'DetailPlanController@create')->name('create');
        Route::get('/{url}/details/{idDetail}', 'DetailPlanController@show')->name('show');
        Route::put('/{url}/details/{idDetail}', 'DetailPlanController@update')->name('update');
        Route::get('/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('edit');
        Route::post('/{url}/details', 'DetailPlanController@store')->name('store');
        Route::get('/{url}/details', 'DetailPlanController@index')->name('index');
    });

    /**
     * Routes Plans
     */
    Route::group([
        'prefix' => 'plans',
        'as' => 'plans.'
    ], function () {
        Route::match(['get', 'post'],'search', 'PlanController@search')->name('search');
        Route::post('/', 'PlanController@store')->name('store');
        Route::get('create', 'PlanController@create')->name('create');
        Route::get('/', 'PlanController@index')->name('index');
        Route::put('/{url}', 'PlanController@update')->name('update');
        Route::get('/{url}/edit', 'PlanController@edit')->name('edit');
        Route::delete('/{url}', 'PlanController@destroy')->name('destroy');
        Route::get('/{url}', 'PlanController@show')->name('show');
    });

});


/**
 * Site
 */
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
 * Auth Routes
 */
Auth::routes();
