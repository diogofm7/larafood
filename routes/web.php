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
     * Routes Tenants
     */
    Route::match(['get', 'post'],'tenants/search', 'TenantController@search')->name('tenants.search');
    Route::resource('tenants', 'TenantController')->except(['create', 'store']);

    /**
     * Routes tables
     */
    Route::match(['get', 'post'],'tables/search', 'TableController@search')->name('tables.search');
    Route::resource('tables', 'TableController');

    /**
     * Routes Product x Category
     */
    Route::get('products/{idProduct}/categories/{idCategory}/detach', 'CategoryProductController@categoriesDetach')->name('products.categories.detach');
    Route::post('products/{idProduct}/categories/attach', 'CategoryProductController@categoriesAttach')->name('products.categories.attach');
    Route::match(['get', 'post'],'products/{idProduct}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::match(['get', 'post'],'products/{idProduct}/categories', 'CategoryProductController@categories')->name('products.categories');
    Route::match(['get', 'post'],'categories/{idCategory}/products', 'CattabegoryProductController@products')->name('categories.products');

    /**
     * Routes Products
     */
    Route::match(['get', 'post'],'products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');

    /**
     * Routes Categories
     */
    Route::match(['get', 'post'],'categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    /**
     * Routes Users
     */
    Route::match(['get', 'post'],'users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');

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
