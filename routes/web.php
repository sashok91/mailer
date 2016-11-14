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
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::resource('admin', 'AdminController');
Route::resource('subscriber', 'SubscriberController');
Route::resource('mailinggroup', 'MailingGroupController');
Route::get('/mailinggroup/{mailinggroup}/subscriber', 'MailingGroupController@indexSubscriber');
Route::delete('/mailinggroup/{mailinggroup}/subscriber/{subscriber}', 'MailingGroupController@deleteSubscriber');
Route::post('/mailinggroup/{mailinggroup}/subscriber/{subscriber}', 'MailingGroupController@addSubscriber');