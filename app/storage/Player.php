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
        if($this->warrior->feel()->isEmpty())
        {
              //$this->warrior->walk();
        }
  	}
}