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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories','CategoriesController');

Route::post('categories','CategoriesController@store')->name('categories.store');

Route::get('categories/{category}/edit','CategoriesController@edit')->name('categories.edit');

Route::put('categories/{category}', 'CategoriesController@update')->name('categories.update');

Route::get('/categories','CategoriesController@index')->name('categories.index');

Route::get('/search/categories','CategoriesController@search')->name('categories.search');

Route::get('/categories/create','CategoriesController@create')->name('categories.create');


Route::resource('articles', 'ArticlesController');

Route::get('/articles/create','ArticlesController@create')->name('articles.create');

Route::get('/articles/{article}','ArticlesController@show')->name('articles.show');

Route::put('/articles/{article}','ArticlesController@update')->name('articles.update');

Route::get('/search/articles' , 'ArticlesController@search')->name('articles.search');

Route::view('/test', 'test');
