<?php

use App\Http\Controllers\Api\{
    CategoryController,
    OrderController,
    ProductController,
    TenantController,
    TableController
};
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\Client;
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

Route::post('/sanctum/token', [AuthClientController::class, 'auth']);

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'auth',
    'namespace' => 'Auth',
], function () {
    Route::get('/me', [AuthClientController::class, 'me']);
    Route::post('/logout', [AuthClientController::class, 'logout']);
});



Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/tenants/{uuid}', [TenantController::class, 'show']);
    Route::get('/tenants', [TenantController::class, 'index']);

    Route::get('/categories/{uuid}', [CategoryController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'categoriesByTenant']);

    Route::get('/tables/{uuid}', [TableController::class, 'show']);
    Route::get('/tables', [TableController::class, 'tablesByTenant']);


    Route::get('/products', [ProductController::class, 'productsByTenant']);
    Route::get('/products/{uuid}', [ProductController::class, 'show']);

    Route::post('/client', [RegisterController::class, 'store']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{identify}', [OrderController::class, 'show']);
});
