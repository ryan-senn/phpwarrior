<?php namespace Services\Game\Skills;


class Attack extends Skill
{
	
	public function execute($direction = 'forward')
	{
		$space = $this->unit->getSpace($direction);

		if($space->isWall())
		{
			$this->unit->addEvent('attacks and hits a wall');
		}
		elseif($receiver = $space->getUnit())
		{
			$this->unit->damage($receiver);

			if(!$receiver->isAlive())
			{
				$this->unit->addEvent('killed '. $receiver::NAME);
				$receiver->setPosition(null);
			}
		}
		else
		{
			$this->unit->addEvent('attacks and hits nothing');
		}
	}
}