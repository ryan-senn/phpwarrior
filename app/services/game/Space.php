<?php namespace Services\Game;

use Services\Game\Location;


class Space
{
	
	protected $location;


	public function __construct(Location $location)
	{
		$this->location = $location;
	}


	public function isEmpty()
	{
		
	}


	public function isEnnemy()
	{
		
	}
}