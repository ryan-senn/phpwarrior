<?php namespace Services\Game\Units;

use Services\Game\Position;


class Ooze extends Unit
{

	const NAME = 'Ooze';

	protected $health = 10;
	protected $attack = 3;

	protected $skills = ['feel', 'attack'];


	public function playTurn()
	{
		foreach(Position::getDirections()['relative'] as $direction)
		{
			$space = $this->feel($direction);

			if($space->isWarrior())
			{
				$this->attack($direction);
				return;
			}
		}
	}
}