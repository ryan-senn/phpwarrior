<?php namespace Services\Game;

use Services\Game\Units\Warrior;
use Services\Game\Units\Unit;


class Space
{
	
	protected $map;
	protected $x;
	protected $y;


	public function __construct(Map $map, $x, $y)
	{
		$this->map = $map;
		$this->x = $x;
		$this->y = $y;
	}


	public function getX()
	{
		return $this->x;
	}


	public function getY()
	{
		return $this->y;
	}


	public function isWall()
	{
		return $this->map->isOut($this->x, $this->y);
	}


	public function isWarrior()
	{
		return $this->getUnit() instanceof Warrior;
	}


	public function isEnnemy()
	{
		return $this->getUnit() instanceof Unit && !$this->isWarrior();
	}


	public function isEmpty()
	{
		return is_null($this->getUnit()) && !$this->isWall();
	}


	public function isStairs()
	{
		return $this->map->getStairsLocation() == ['x' => $this->x, 'y' => $this->y];
	}


	public function getUnit()
	{
		return $this->map->getUnit($this->x, $this->y);
	}
}