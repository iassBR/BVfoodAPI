<?php

use App\Http\Controllers\Api\{
    CategoryController,
    ProductController,
    TenantController,
    TableController
};
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

Route::get('/teste', function() {
    $client = Client::first();

    $token = $client->createToken('token-pow');

    dd($token->plainTextToken);
});
 

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function () {
    Route::get('/tenants/{uuid}', [TenantController::class, 'show']);
    Route::get('/tenants', [TenantController::class, 'index']);

    Route::get('/categories/{url}', [CategoryController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'categoriesByTenant']);

    Route::get('/tables/{identify}', [TableController::class, 'show']);
    Route::get('/tables', [TableController::class, 'tablesByTenant']);


    Route::get('/products', [ProductController::class, 'productsByTenant']);
    Route::get('/products/{flog}', [ProductController::class, 'show']);

    Route::post('/client', [RegisterController::class, 'store']);

    Route::post('/sanctum/token', [AuthClientController::class, 'auth']);


});
