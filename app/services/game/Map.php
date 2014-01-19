<?php namespace Services\Game;

class Map
{
	
	protected $elements = [];


	public function __construct($height, $width)
	{
		for($h = 0; $h < $height; $h++)
		{
			for($w = 0; $w < $width; $w++)
			{
				$location = new Location($h, $w);
				$void = new Void($location);

				$this->setElement($void);
			}
		}
	}


	public function setElement(Element $element)
	{
		$location = $element->getLocation();

		$this->elements[$location->getX()][$location->getY()] = $element;
	}


	public function getElements()
	{
		return $this->elements;
	}
}