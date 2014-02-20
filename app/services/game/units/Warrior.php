<?php namespace Services\Game\Units;

use Services\Game\Space;
use Services\Game\Items\Potion;


class Warrior extends Unit
{

	const NAME = 'Warrior';

	protected $health = 20;
	protected $attack = 3;

	protected $potion;


	public function setPotion(Potion $potion)
	{
		$this->potion = $potion;
	}


	public function getPotion()
	{
		return $this->potion;
	}


	public function getDirectionOfStairs()
	{
		return $this->position->getRelativeDirectionOfStairs();
	}
}