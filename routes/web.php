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

Auth::routes() ;

Route::resource('categories','CategoriesController');
Route::resource('articles', 'ArticlesController');
Route::resource('user', 'UserController');

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/','CategoriesController@index')->name('categories.index');
Route::get('/categories','CategoriesController@index')->name('categories.index');
Route::get('/articles/{article}','ArticlesController@show')->name('articles.show');
Route::get('/search/categories','CategoriesController@search')->name('categories.search');
Route::get('/search/articles' , 'ArticlesController@search')->name('articles.search');
Route::post('/download','ArticlesController@download')->name('articles.download');

Route::post('categories','CategoriesController@store')->name('categories.store');
Route::get('categories/{category}/edit','CategoriesController@edit')->name('categories.edit');
Route::put('categories/{category}', 'CategoriesController@update')->name('categories.update');
Route::get('/categories/create','CategoriesController@create')->name('categories.create');


Route::get('/articles/create','ArticlesController@create')->name('articles.create');
Route::put('/articles/{article}','ArticlesController@update')->name('articles.update');

Route::get('/user','UserController@index')->name('user.index');
Route::get('/user/{user}/edit','UserController@edit')->name('user.edit');
Route::get('/user/{user}/edit2','UserController@edit2')->name('user.edit2');
Route::put('/user/{user}/edit2','UserController@update2')->name('user.update2');
Route::get('/search/user','UserController@search')->name('user.search');


Route::get('/json/articles/{id}','ArticlesToJsonController@show');


Route::group(['prefix' => 'auth'], function () {

});

Route::group(['prefix' => 'admin'], function () {


});