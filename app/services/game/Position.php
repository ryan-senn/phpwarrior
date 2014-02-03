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


	public function getX()
	{
		return $this->x;
	}


	public function getY()
	{
		return $this->y;
	}


	public function isAt($x, $y)
	{
		return $this->x == $x && $this->y == $y;
	}


	public function getDirection()
	{
		return self::$directions['absolute'][$this->direction_index];
	}


	public function getRelativeDirectionOfStairs()
	{
		$location = $this->map->getStairsLocation();

		$x = $this->x - $location['x'];
		$y = $this->y - $location['y'];

		if(abs($x) > abs($y))
		{
			if($x > 0)
			{
				return '';
			}
		}
		else
		{

		}
	}


	public function getSpace()
	{
		return $this->map->getSpace($this->x, $this->y);
	}


	public function move($direction)
	{
		$relative_direction = $this->getAbsoluteDirection($direction);

		// update the direction
		$this->direction_index = array_search($relative_direction, self::$directions['absolute']);

		// update the position
		switch($relative_direction)
		{
			case 'north':
				$this->y += 1;
				break;
			case 'east':
				$this->x += 1;
				break;
			case 'south':
				$this->y -= 1;
				break;
			case 'west':
				$this->x -= 1;
				break;
			default:
				throw new \Exception('Invalid direction');
		}
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


	public function __toString()
	{
		return $this->getX() .'/'. $this->getY();
	}
}