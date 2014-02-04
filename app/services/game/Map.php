<?php namespace Services\Game;

use Services\Game\Units\Unit;
use Services\Game\Units\Warrior;


class Map
{
	
	protected $height = 0;
	protected $width = 0;
	protected $units = [];
	protected $stairs_location = ['x' => -1, 'y' => -1];


	public function __construct($height, $width)
	{
		$this->height = $height;
		$this->width = $width;
	}


	public function getHeight()
	{
		return $this->height;
	}


	public function getWidth()
	{
		return $this->width;
	}


	public function addUnit(Unit $unit)
	{
		$this->units[] = $unit;
	}


	public function placeStairs($x, $y)
	{
		$this->stairs_location = ['x' => $x, 'y' => $y];
	}


	public function getStairsSpace()
	{
		return $this->getSpace($this->stairs_location['x'], $this->stairs_location['y']);
	}


	public function getStairsLocation()
	{
		return $this->stairs_location;
	}


	public function getUnits()
	{
		return array_filter($this->units, function($unit)
		{
			return !is_null($unit->getPosition());
		});
	}


	public function getOtherUnits()
	{
		return array_filter($this->getUnits(), function($unit)
		{
			return !$unit instanceof Warrior;
		});
	}


	public function getWarrior()
	{
		foreach($this->getUnits() as $unit)
		{
			if($unit instanceof Warrior)
			{
				return $unit;
			}
		}
	}


	public function getUnit($x, $y)
	{
		foreach($this->getUnits() as $unit)
		{
			if($unit->getX() == $x && $unit->getY() == $y)
			{
				return $unit;
			}
		}

		return null;
	}


	public function getSpace($x, $y)
	{
		return new Space($this, $x, $y);
	}


	public function isOut($x, $y)
	{
		return $x < 0 || $x >= $this->width || $y < 0 || $y >= $this->height;
	}


	/**
	 * force deep cloning instead of shallow cloning
	 *
	 * Reference: http://cupfullofcode.com/php-clone-and-shallow-vs-deep-copying/
	 */
	public function __clone()
	{
        foreach($this as $key => $value)
        {
            if(is_object($value) || (is_array($value)))
            {
                $this->{$key} = unserialize(serialize($value));
            } 
        }
    }
}