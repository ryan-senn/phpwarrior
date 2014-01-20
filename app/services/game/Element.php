<?php namespace Services\Game;

abstract class Element
{
	
	protected $position;


	public function __construct(Position $position)
	{
		$this->position = $position;
	}


	public function getPosition()
	{
		return $this->position;
	}
}