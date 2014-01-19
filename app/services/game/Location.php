<?php namespace Services\Game;

class Location
{

	protected $coords;

	
	public function __construct($x, $y)
	{
		$this->coords = ['x' => $x, 'y' => $y];
	}


	public function getSpace($direction)
	{
		return new Space();
	}


	public function getCoords()
	{
		return $this->coords;
	}


	public function getX()
	{
		return $this->coords['x'];
	}


	public function getY()
	{
		return $this->coords['y'];
	}
}