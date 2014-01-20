<?php namespace Services\Game;

class Map
{
	
	protected $height;
	protected $width;
	protected $elements = [];


	public function __construct($height, $width)
	{
		$this->height = $height;
		$this->width = $width;

		for($x = 0; $x < $width; $x++)
		{
			for($y = 0; $y < $height; $y++)
			{
				$position = new Position($this, $x, $y);
				$this->elements[$x][$y] = new Void($position);
			}
		}
	}


	public function setElement(Element $element)
	{
		$position = $element->getPosition();

		$this->elements[$position->getX()][$position->getY()] = $element;
	}


	public function moveElement(Element $element)
	{
		
	}


	public function getElements()
	{
		return $this->elements;
	}


	public function getPosition($x, $y)
	{
		return $this->elements[$x][$y];
	}
}