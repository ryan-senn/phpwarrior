<?php namespace Services\Game;

use Services\Game\Position;


class Space
{
	
	protected $position;


	public function __construct(Position $position)
	{
		$this->position = $position;
	}


	public function isEmpty()
	{
		$map = $this->position->getMap();
		$space = $map->getPosition($this->position->getX(), $this->position->getY());

		return is_null($space);
	}


	public function isEnnemy()
	{
		
	}
}