<?php

Route::get('/{map}', [
	'as' => 'game.index',
	'uses' => 'GameController@index',
])->where(['map' => '[0-9]+']);

Route::post('/submit', [
	'as' => 'game.submit',
	'uses' => 'GameController@submit',
]);

Route::get('/simulate', [
	'as' => 'game.simulate',
	'uses' => 'GameController@simulate',
]);