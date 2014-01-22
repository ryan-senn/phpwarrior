<?php namespace Services\Game;

use Services\Game\Events;


class Potion
{

	protected $charges = 10;


	public function drink()
	{
		if($this->charges > 0)
		{
			$this->charges -= 1;

			Events::add('Warrior takes a sip from his potion. The potion has '. $this->charges .' charges remaining.');

			return true;
		}

		return false;
	}
}