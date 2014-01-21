<?php namespace Services\Game\Unit;

use Services\Game\Space;


class Warrior extends Unit
{

	const NAME = 'Warrior';

	protected $health = 20;
	protected $attack = 3;


	public function walk($direction = 'forward')
	{
		self::addLog('walks '. $direction);

		if($this->getSpace($direction)->isEmpty())
		{
			$offset = $this->getOffset($direction);

			$this->position->move($offset['x'], $offset['y']);
		}
		else
		{
			self::addLog('bumps into '. $this->getSpace($direction)->getUnit());
		}
	}


	public function rest()
	{
		self::addLog('rests');

		$this->gainHealth(2);
	}
}