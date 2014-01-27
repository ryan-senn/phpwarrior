<?php

Route::get('/', [
	'as' => 'game.index',
	'uses' => 'GameController@index',
]);

Route::post('/submit', [
	'as' => 'game.submit',
	'uses' => 'GameController@submit',
]);

Route::get('/simulate', [
	'as' => 'game.simulate',
	'uses' => 'GameController@simulate',
]);