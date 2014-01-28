<?php namespace Services\Game\Skills;

use Services\Game\Items\Potion;


class Drink extends Skill
{

	public function execute(Potion $potion)
	{
		if($potion->isEmpty())
		{
			$this->unit->addEvent('drinks some air from an empty potion');
		}
		else
		{
			$potion->removeCharge();
			$this->unit->gainHealth($potion->getRegeneration());
			$this->unit->addEvent('drinks from a potion and restores '. $potion->getRegeneration());
		}
	}
}