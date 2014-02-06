<?php namespace Services\Game;


class Position
{

	protected $map;
	protected $x;
	protected $y;
	protected $direction_index;

	protected static $directions = [
		'absolute' => ['north', 'east', 'south', 'west'],
		'relative' => ['forward', 'right', 'backward', 'left'],
	];

	
	public function __construct(Map $map, $x, $y, $direction = 'north')
	{
		$this->map = $map;
		$this->x = $x;
		$this->y = $y;
		$this->direction_index = array_search($direction, self::$directions['absolute']);
	}


	public static function getDirections()
	{
		return self::$directions;
	}


	public function getDirection()
	{
		return self::$directions['absolute'][$this->direction_index];
	}


	public function getX()
	{
		return $this->x;
	}


	public function getY()
	{
		return $this->y;
	}


	public function getSpace()
	{
		return $this->map->getSpace($this->x, $this->y);
	}


	public function isAt($x, $y)
	{
		return $this->x == $x && $this->y == $y;
	}


	public function move($direction)
	{
		// update the position
		$space = $this->getRelativeSpace($direction);
		$this->x = $space->getX();
		$this->y = $space->getY();

		// update the direction
		$absolute_direction = $this->getAbsoluteDirection($direction);
		$this->direction_index = array_search($absolute_direction, self::$directions['absolute']);
	}


	public function getRelativeSpace($direction)
	{
		$absolute_direction = $this->getAbsoluteDirection($direction);

		$x = $this->getX();
		$y = $this->getY();

		switch($absolute_direction)
		{
			case 'north':
				$y += 1;
				break;
			case 'east':
				$x += 1;
				break;
			case 'south':
				$y -= 1;
				break;
			case 'west':
				$x -= 1;
				break;
		}

		return $this->map->getSpace($x, $y);
	}


	public function getAbsoluteDirection($direction)
	{
		$rotation = array_search($direction, self::$directions['relative']);

		$direction = $this->direction_index;
		$direction += $rotation;

		if($direction > 3)
		{
			$direction -= 4;
		}

		return self::$directions['absolute'][$direction];
	}


	public function getAbsoluteDirectionOfSpace(Space $space)
	{
		if(abs($this->x - $space->getX()) > abs($this->y - $space->getY()))
		{
			return $this->x < $space->getX() ? 'east' : 'west';
		}

		return $this->y < $space->getY() ? 'north' : 'south';
  	}


	public function getRelativeDirectionOfSpace(Space $space)
	{
		$direction = $this->getAbsoluteDirectionOfSpace($space);
		
		$offset = array_search($direction, self::$directions['absolute']) - $this->direction_index;

		if($offset < 0)
		{
			$offset += 4;
		}

		return self::$directions['relative'][$offset];
	}


	public function getRelativeDirectionOfStairs()
	{
		return $this->getRelativeDirectionOfSpace($this->map->getStairsSpace());
	}
    

	public function __toString()
	{
		return $this->getX() .'/'. $this->getY();
	}
}