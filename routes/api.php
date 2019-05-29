<?php

use Illuminate\Http\Request;

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

Route::post('categories/load', 'Api\CategoriesController@load')->name('categories_load_api');

Route::get('categories/load_parent', 'Api\CategoriesController@loadParents')->name('categories_load_parents_api');

Route::post('posts/load', 'Api\PostsController@load')->name('posts_load_api');

Route::post('tips/load', 'Api\TipsController@load')->name('tips_load_api');

