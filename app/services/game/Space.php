<?php namespace Services\Game;

use Services\Game\Unit\Warrior;


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


	public function isPlayer()
	{
		return $this->isWarrior();
	}


	public function isEnnemy()
	{
		return !$this->isPlayer();
	}


	public function isEmpty()
	{
		return is_null($this->getUnit()) && !$this->isWall();
	}


	public function isStairs()
	{
		$this->map->stairs_location == [$this->x, $this->y];
	}


	public function getUnit()
	{
		return $this->map->getUnit($this->x, $this->y);
	}
}