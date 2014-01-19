<?php

class Player
{

	protected $warrior;


	public function __construct($warrior)
	{
		$this->warrior = $warrior;
	}
	

  	public function play_turn()
  	{
    	Log::info('played a turn');
  	}
}