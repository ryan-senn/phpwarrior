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
		elseif($this->getSpace($direction)->isWall())
		{
			self::addLog('bumps into a wall');
		}
		elseif(($this->getSpace($direction)->isEnnemy()))
		{
			self::addLog('bumps into '. $this->getSpace($direction)->getUnit());
		}

		self::addLog('position is '. $this->getPosition());
	}


	public function rest()
	{
		$this->gainHealth(2);

		self::addLog('rests and gains 2 health. He is back to '. $this->health .' health.');
	}
}