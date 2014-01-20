<?php namespace Services\Game;

class Position
{

	protected $map;
	protected $coords;
	protected $direction;

	protected $directions = [
		'absolute' => ['north', 'east', 'south', 'west'],
		'relative' => ['forward', 'right', 'backward', 'left'],
	];

	
	public function __construct(Map $map, $x, $y, $direction = null)
	{
		$this->map = $map;
		$this->coords = ['x' => $x, 'y' => $y];

		$this->direction = is_null($direction) ? $this->directions['absolute'][2] : $direction;
	}


	public function getMap()
	{
		return $this->map;
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


	public function move($direction)
	{
		$position = $this->getRelativeTo($direction);

		$this->coords['x'] = $position->getX();
		$this->coords['y'] = $position->getY();

		$this->map->moveElement();
	}


	public function getRelativeTo($direction)
	{
		$x = $this->getX();
		$y = $this->getY();

		switch($this->direction)
		{
			case 'north':
				switch($direction)
				{
					case 'forward':
						$y += 1;
						break;
					case 'backward':
						$y -= 1;
						break;
					case 'right':
						$x += 1;
						break;
					case 'left':
						$x -= 1;
						break;
				}
				break;
			case 'south':
				switch($direction)
				{
					case 'forward':
						$y += 1;
						break;
					case 'backward':
						$y -= 1;
						break;
					case 'right':
						$x -= 1;
						break;
					case 'left':
						$x += 1;
						break;
				}
				break;
			case 'east':
				switch($direction)
				{
					case 'forward':
						$x += 1;
						break;
					case 'backward':
						$x -= 1;
						break;
					case 'right':
						$y += 1;
						break;
					case 'left':
						$y -= 1;
						break;
				}
				break;
			case 'west':
				switch($direction)
				{
					case 'forward':
						$x -= 1;
						break;
					case 'backward':
						$x += 1;
						break;
					case 'right':
						$y -= 1;
						break;
					case 'left':
						$y += 1;
						break;
				}
			break;
		}

		return new Position($this->map, $x, $y);
	}
}