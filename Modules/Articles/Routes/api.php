<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\ApiArticleController;

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

Route::middleware('auth:api')->get('/article', function (Request $request) {
    return $request->user();
});

// route::prefix('lynx')->group(function () {
//     Route::get('articles', [ArticleController::class, 'indexAny']);
//     Route::middleware('auth:api')->group(function () {
//         Route::apiResource('articles', ArticleController::class);
//         Route::post('articles/restore/{id}', [ArticleController::class, 'restore']);
//         Route::delete('articles/force/delete/{id}', [ArticleController::class, 'forceDelete']);
//     });
// });


route::middleware('auth:api')->group(function () {
    route::apiResource('articles', ApiArticleController::class);
    route::post('articles/restore/{id}', [ApiArticleController::class, 'restore']);
    route::delete('articles/force-delete/{id}', [ApiArticleController::class, 'forceDelete']);
});
