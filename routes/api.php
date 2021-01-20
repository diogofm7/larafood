<?php

use App\Http\Controllers\Api\{
    TenantApiController,
    CategoryApiController,
    TableApiController,
    ProductApiController
};

Route::get('/tenants/{uuid}', [TenantApiController::class, 'show']);
Route::get('/tenants', [TenantApiController::class, 'index']);

Route::get('/categories/{url}', [CategoryApiController::class, 'show']);
Route::get('/categories', [CategoryApiController::class, 'categoriesByTenant']);

Route::get('/tables/{identify}', [TableApiController::class, 'show']);
Route::get('/tables', [TableApiController::class, 'tablesByTenant']);

Route::get('/products', [ProductApiController::class, 'productsByTenant']);
