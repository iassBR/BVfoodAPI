<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController,
    TenantController,
    TableController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/tenants/{uuid}', [TenantController::class, 'show']);
Route::get('/tenants', [TenantController::class, 'index']);

Route::get('/categories/{url}', [CategoryController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'categoriesByTenant']);

Route::get('/tables/{identify}', [TableController::class, 'show']);
Route::get('/tables', [TableController::class, 'tablesByTenant']);


// Route::get('/tables/{identify}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'productsByTenant']);

