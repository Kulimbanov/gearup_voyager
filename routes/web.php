<?php

use App\Http\Controllers\PageController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\ProductCategory;

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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get(RouteServiceProvider::SHOP . '/{categorySlug}/{productSlug}/', [PageController::class, 'product']);

Route::get(RouteServiceProvider::SHOP . '/{categorySlug}', [PageController::class, 'shop'])
     ->where('categorySlug', '[\/\w\.-]*');

Route::get('/{slug?}', [PageController::class, 'index'])->where('slug', '[\/\w\.-]*');
