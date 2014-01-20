<?php

Route::get('/', [
	'as' => 'home.index',
	'uses' => 'HomeController@index',
]);

Route::get('/mock', [
	'as' => 'home.mock',
	'uses' => 'HomeController@mock',
]);

Route::post('/game', [
	'as' => 'game.submit',
	'uses' => 'HomeController@submit',
]);