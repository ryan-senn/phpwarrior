<?php

Route::get('/', [
	'as' => 'home.index',
	'uses' => 'HomeController@index',
]);

Route::post('/game', [
	'as' => 'game.submit',
	'uses' => 'HomeController@submit',
]);