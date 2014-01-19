<?php namespace Services\Game;

abstract class Element
{
	
	protected $location;


	public function __construct(Location $location)
	{
		$this->location = $location;
	}


	public function getLocation()
	{
		return $this->location;
	}
}