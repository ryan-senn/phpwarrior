<?php namespace Services\Game\Units;

use Services\Game\Position;


class Ooze extends Unit
{

	const NAME = 'Ooze';

	protected $health = 10;
	protected $attack = 3;


	public function playTurn()
	{
		foreach(Position::getDirections()['relative'] as $direction)
		{
			$space = $this->feel($direction);

			if($space->isPlayer())
			{
				$this->attack($direction);
				return;
			}
		}
	}
}