<?php namespace Services\Game\Unit;

use Services\Game\Space;


class Warrior extends Unit
{

	public function feel($direction = 'forward')
	{
		$this->addLog('warrior feels '. $direction);

		return new Space($this->position->getRelativeTo($direction));
	}


	public function walk($direction = 'forward')
	{
		$this->addLog('warrior walks '. $direction);

		$this->position->move($direction);
	}


	public function rest()
	{
		$this->addLog('warrior rests');

		$this->gainHealth(2);
	}
}