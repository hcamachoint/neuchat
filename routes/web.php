<?php

Auth::routes();
Route::get('/',function(){return view('welcome');});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/list', 'UserController@list');
Route::group(['prefix' => 'messages'], function () {
  Route::get('/','MessageController@chatPage')->name('chat');
	Route::get('/{userId}', 'MessageController@messageget')->name('message-user');
	Route::post('/{userId}', 'MessageController@messagepost')->name('message-new');
	Route::post('/messagefile/{userId}', 'MessageController@messagefile')->name('message-file');
});
