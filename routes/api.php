<?php


use App\Http\Controllers\api\CategoriesController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\StoreController;
use App\Http\Controllers\NavaPoshtaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
    Route::post('/', [\App\Http\Controllers\User\StoreController::class, 'index']);

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('/me', [\App\Http\Controllers\AuthController::class, 'me']);
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('getOrder', [\App\Http\Controllers\api\OrderProductController::class, 'getOrder']);

    });

});

Route::get('categories', [CategoriesController::class, 'index'])->name('categories');


Route::get('categories', [CategoriesController::class, 'index'])->name('categories');

Route::get('region', [NavaPoshtaController::class, 'showRegions']);
Route::get('region/{region}', [NavaPoshtaController::class, 'showRegionCities']);
Route::get('postalOffices/{cityRef}', [NavaPoshtaController::class, 'showPostalOffices']);
Route::post('postalOffices', [NavaPoshtaController::class, 'showPostalOffices']);
Route::get('postalPostomat/{cityRef}', [NavaPoshtaController::class, 'showPostalPostomat']);
Route::post('addData', [\App\Http\Controllers\api\OrderProductController::class, 'addData']);

Route::get('/products/{productId}/ratings', [ProductsController::class, 'ratings']);


//Route::get('products', [ProductsController::class, 'index'])->name('products');
Route::get('/items', [ProductsController::class, 'index']);
Route::get('/showRecommendation', [ProductsController::class, 'showRecommendationProducts']);
Route::post('create', [StoreController::class, 'index']);
Route::get('/product/{id}', [ProductsController::class, 'showProduct']);
Route::get('/allComments/{id}', [ProductsController::class, 'allComments']);
Route::post('/product/{productId}/comments', [ProductsController::class, 'storeComment']);

Route::get('categories/{id}', [CategoriesController::class, 'show']);

