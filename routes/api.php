<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\UsersApiController;
use App\Http\Controllers\Auth\VerificationApiController;
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

//Route::post('login', [UserController::class, 'login']);
//Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware(['auth:sanctum', 'api']);
Route::post('password', [UserController::class, 'resetPassword']);

Route::post('login', [UsersApiController::class, 'login']);
Route::post('register', [UsersApiController::class, 'register']);

//Route::group(['middleware' => 'auth:api'], function () {
//    Route::post('details', 'UsersApiController@details')->middleware('verified');
//}); // will work only when user has verified the email
Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->post('/category/properties/', [ProductController::class, 'getProperties'])
     ->name('category.properties');

Route::middleware('api')->get('/products/featured', [ProductController::class, 'getFeaturedProducts']);

Route::middleware('api')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('services', ServicesController::class);
    Route::resource('contact', ContactController::class);
});
