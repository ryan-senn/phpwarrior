<?php namespace Services\Game\Items;


class Potion extends Item
{

	protected $charges = 10;
	protected $regeneration = 2;


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
}