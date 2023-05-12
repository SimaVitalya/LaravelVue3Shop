<?php

use App\Http\Controllers\api\api\api\CategoriesController;
use App\Http\Controllers\api\api\api\ProductsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', [ProductsController::class, 'index'])->name('products');
Route::get('categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('products/{id}', [ProductsController::class, 'show'])->name('products.show');
Route::post('createproduct', [\App\Http\Controllers\api\StoreController::class, 'index'])->name('createproduct');

Route::get('/test-axios', function () {
    $response = \Illuminate\Support\Facades\Http::get('https://jsonplaceholder.typicode.com/posts');
    return $response->json();
});
