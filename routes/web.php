<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/subscriber/create', 'SubscriberController@createSubscriber');

Route::get('/adminpanel/admins', 'AdminsController@showAdminListView');
Route::get('/adminpanel/showcreateview', 'AdminsController@showAdminCreateView');
Route::get('/adminpanel/showupdateview/{id}', 'AdminsController@showAdminUpdateView');

Route::post('/admin/create', 'AdminsController@create');
Route::post('/admin/update', 'AdminsController@update');
Route::get('/admin/delete/{id}', 'AdminsController@delete');
