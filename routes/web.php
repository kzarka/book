<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/classes.html', 'ClassesController@index')->name('class');

Route::get('/about.html', 'HomeController@index')->name('about');

Route::get('/contact.html', 'HomeController@index')->name('contact');

// category
Route::get('/blog/', 'CategoriesController@index')->name('category_list');

Route::get('/blog/{categoryIdentity}.html', 'CategoriesController@index')->name('category');
// post
Route::get('/blog/{categoryIdentity}/{postIdentity}.html', 'PostsController@index')->name('post')
	->middleware('postcountfilter');

Route::get('theme/set', 'MainController@setTheme')->name('set_theme_api');

Route::match(['get', 'post'], '/login', 'Auth\LoginController@login')->name('login')->middleware('guest');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::match(['get', 'post'], '/register', 'Auth\RegisterController@register')->name('register');

Route::namespace('Admin')->prefix('admin')->middleware('auth', 'check.admin')->group(function () {

	Route::get('/dashboard', 'MainController@index')->name('admin_dashboard');

	Route::get('/', function () {
		return redirect()->route('admin_dashboard');
	});
	//class
	Route::get('/classes/list', 'ClassesController@index')->name('admin_classes');

	Route::delete('classes/delete/{id}', 'ClassesController@delete')->name('admin_delete_class');

	Route::match(['get', 'post'], '/classes/create', 'ClassesController@create')->name('admin_create_class');

	Route::match(['get', 'post'], '/classes/edit/{id}', 'ClassesController@edit')->name('admin_edit_class');

	//category
	Route::get('/categories/list', 'CategoriesController@index')->name('admin_categories');

	Route::post('/categories/create', 'CategoriesController@create')->name('admin_category_create');

	Route::POST('/categories/load', 'CategoriesController@load')->name('admin_category_load');

	Route::post('/categories/update/{id}', 'CategoriesController@update')->name('admin_category_update');

	Route::delete('categories/delete/{id}', 'CategoriesController@delete')->name('admin_category_delete');

	// post
	Route::get('/posts/list', 'PostsController@index')->name('admin_posts');

	Route::match(['get', 'post'], '/posts/create', 'PostsController@create')->name('admin_create_post');

	Route::match(['get', 'post'], '/posts/edit/{id}', 'PostsController@edit')->name('admin_edit_post');

	Route::delete('posts/delete/{id}', 'PostsController@delete')->name('admin_post_delete');

	//tips
	Route::get('/tips/list', 'TipsController@index')->name('admin_tips');

	Route::post('/tips/create', 'TipsController@create')->name('admin_tip_create');

	Route::POST('/tips/load', 'TipsController@load')->name('admin_tip_load');

	Route::post('/tips/update/{id}', 'TipsController@update')->name('admin_tip_update');

	Route::delete('/tips/delete/{id}', 'TipsController@delete')->name('admin_tip_delete');

	// boss

	Route::match(['get', 'post'], '/bosses', 'BossController@index')->name('admin_bosses');

});
