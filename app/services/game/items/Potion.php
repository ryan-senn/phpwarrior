<?php namespace Services\Game\Items;


class Potion extends Item
{

	protected $charges = 10;
	protected $regeneration = 2;


	public function __construct($charges, $regeneration)
	{
		$this->charges = $charges;
		$this->regeneration = $regeneration;
	}


	public function isEmpty()
	{
		return $this->charges <= 0;
	}


	public function removeCharge()
	{
		$this->charges -= 1;
	}


	public function getRegeneration()
	{
		return $this->regeneration;
	}


	public function getCharges()
	{
		return $this->charges;
	}
}