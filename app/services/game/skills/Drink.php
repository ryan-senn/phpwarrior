<?php namespace Services\Game\Skills;

use Services\Game\Items\Potion;


class Drink extends Skill
{

	protected static $isAction = true;
	protected static $description = 'Takes a sip from the potion to heal up';


	public function execute()
	{
		$potion = $this->unit->getPotion();

		if($potion->isEmpty())
		{
			$this->unit->addEvent('drinks some air from an empty potion');
		}
		else
		{
			$potion->removeCharge();
			$this->unit->gainHealth($potion->getRegeneration());
			$this->unit->addEvent('drinks from a potion and restores '. $potion->getRegeneration() .' health. '. $potion->getCharges() .' charges left.');
		}
	}
}