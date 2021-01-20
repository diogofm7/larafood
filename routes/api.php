<?php

use App\Http\Controllers\Api\{
    TenantApiController,
    CategoryApiController,
    TableApiController,
    ProductApiController
};

Route::group([
    'prefix' => 'v1'
], function () {

    Route::get('/tenants/{uuid}', [TenantApiController::class, 'show']);
    Route::get('/tenants', [TenantApiController::class, 'index']);

    Route::get('/categories/{url}', [CategoryApiController::class, 'show']);
    Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);

    Route::get('/tables/{identify}', [TableApiController::class, 'show']);
    Route::get('/tables', [TableApiController::class, 'tablesByTenant']);

    Route::get('/products/{flag}', [ProductApiController::class, 'show']);
    Route::get('/products', [ProductApiController::class, 'productsByTenant']);

});
