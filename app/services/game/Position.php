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

	
	public function __construct(Map $map, $x, $y, $direction = 'south')
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


	public function rotate($amount)
	{
		$this->direction_index += $amount;

		if($this->direction_index > 3)
		{
			$this->direction_index -= 4;
		}

		if($this->direction_index < 0)
		{
			$this->direction_index += 4;
		}
	}


	public function getRelativeSpace($forward, $right = 0)
	{
		$offset = $this->translateOffset($forward, $right);

		return $this->map->getSpace($offset['x'], $offset['y']);
	}


	public function getSpace()
	{
		return $this->map->space($this->x, $this->y);
	}


	public function move($forward, $right = 0)
	{
		$offset = $this->translateOffset($forward, $right);

		$this->x = $offset['x'];
		$this->y = $offset['y'];
	}


	public function getDistanceFromStairs()
	{
		return $this->distanceOf($this->map->getStairsSpace());
	}


	public function getDistanceOf(Space $space)
	{
		return abs($this->x - $space->getX()) + abs($this->y - $space->getY());
	}


	public function getRelativeDirectionOfStairs()
	{
		return $this->getRelativeDirectionOf($this->map->getStairsSpace());
	}


	public function getRelativeDirectionOf(Space $space)
	{
		return $this->getRelativeDirection($this->getDirectionOf($space));
	}

    
    public function getDirectionOf(Space $space)
    {
    	if(abs($this->x - $space->getX()) > abs($this->y - $space->getY()))
    	{
    		return $space->getX() > $this->x ? 'east' : 'west';
    	}

    	return $space->getY() > $this->y ? 'south' : 'north';
    }

    
    public function getRelativeDirection($direction)
    {
    	$offset = array_search($direction, self::$directions['absolute']) - $this->direction_index;

		if($offset > 3)
		{
			$offset -= 4;
		}

		if($offset < 0)
		{
			$offset += 4;
		}

		return self::$directions['relative'][$offset];
    }


	public function translateOffset($forward, $right)
	{
		switch($this->getDirection())
		{
			case 'north':
				return ['x' => $this->x + $right, 'y' => $this->y - $forward];
				break;
			case 'east':
				return ['x' => $this->x + $forward, 'y' => $this->y + $right];
				break;
			case 'south':
				return ['x' => $this->x - $right, 'y' => $this->y + $forward];
				break;
			case 'west':
				return ['x' => $this->x - $forward, 'y' => $this->y - $right];
				break;
		}
	}


	public function __toString()
	{
		return $this->getX() .'/'. $this->getY();
	}
}