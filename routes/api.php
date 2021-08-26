<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ServicesController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/category/properties/', [ProductController::class, 'getProperties'])
     ->name('category.properties');

Route::middleware('api')->get('/products/featured', [ProductController::class, 'getFeaturedProducts']);

Route::middleware('api')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('contact', ContactController::class);
});
