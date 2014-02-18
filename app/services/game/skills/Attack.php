<?php namespace Services\Game\Skills;


class Attack extends Skill
{

	protected static $isAction = true;
	protected static $description = 'Attacks in a given direction (forward by default)';

	
	public function execute($direction = 'forward')
	{
		$space = $this->unit->getSpace($direction);

		if($space->isWall())
		{
			$this->unit->addEvent('attacks and hits a wall');
			return;
		}

		if($space->isStairs())
		{
			$this->unit->addEvent('attacks and hits the stairs');
			return;
		}

		if($receiver = $space->getUnit())
		{
			$this->unit->damage($receiver);

			if(!$receiver->isAlive())
			{
				$this->unit->addEvent('killed '. $receiver::NAME);
				$receiver->setPosition(null);
			}

			return;
		}

		$this->unit->addEvent('attacks and hits nothing');
	}
}