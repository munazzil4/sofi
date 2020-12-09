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
Route::get('/authors', 'AuthorController@index')->name('authors.index');
Route::get('/authors/create', 'AuthorController@create')->name('authors.create');
Route::post('/authors', 'AuthorController@store')->name('authors.store');
Route::get('/authors/{author}/edit', 'AuthorController@edit')->name('authors.edit');
Route::put('/authors/{author}', 'AuthorController@update')->name('authors.update');
Route::delete('/authors/{author}/delete', 'AuthorController@destroy')->name('authors.destroy');

//Route::get('/authors/{author}', 'AuthorController@show')->name('authors.show');

//Route::resource('/authors', 'AuthorController');

Route::resource('/books', 'BookController');

Route::resource('/users', 'UserController');

Route::resource('/permissions', 'PermissionController');

Route::resource('/roles', 'UserRoleController');

Route::get('role/{id}/permissions','UserRoleController@getPermissions');
Route::post('role/{id}/permissions','UserRoleController@updatePermissions');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('vuebooks','ApiController@viewBooks')->name('vuebooks');

Route::get('form', 'ApiController@addBooks')->name('form');