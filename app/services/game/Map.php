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

		for($h = 0; $h < $height; $h++)
		{
			for($w = 0; $w < $height; $w++)
			{
				$this->elements[$h][$w] = null;
			}
		}
	}


	public function setElement(Element $element)
	{
		$position = $element->getPosition();

		$this->elements[$position->getX()][$position->getY()] = $element;
	}


	public function getElements()
	{
		return $this->elements;
	}


	public function getPosition($x, $y)
	{
		return $this->elements[$x][$y];
	}


	public function display()
	{
		$html = '';

		for($h = 0; $h < $this->height; $h++)
		{
			for($w = 0; $w < $this->width; $w++)
			{
				$html .= '['. $this->getPosition($h, $w) .']';
			}
			$html .= '<br />';
		}

		return $html;
	}
}