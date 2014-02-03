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


	public function getSpace()
	{
		return $this->map->getSpace($this->x, $this->y);
	}


	public function move($direction)
	{
		$rotation = array_search($direction, self::$directions['relative']);

		$this->direction_index += $rotation;

		if($this->direction_index > 3)
		{
			$this->direction_index -= 4;
		}

		switch(self::$directions['absolute'][$this->direction_index])
		{
			case 'north':
				$this->x += 1;
				break;
			case 'east':
				$this->y += 1;
				break;
			case 'south':
				$this->x -= 1;
				break;
			case 'west':
				$this->y -= 1;
				break;
			default:
				throw new \Exception('Invalid direction');
		}
	}


	public function __toString()
	{
		return $this->getX() .'/'. $this->getY();
	}
}