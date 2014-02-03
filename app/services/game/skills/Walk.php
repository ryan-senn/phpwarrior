<?php namespace Services\Game\Skills;


class Walk extends Skill
{
	
	public function execute($direction = 'forward')
	{
		$this->unit->addEvent('walks '. $direction);

		$space = $this->unit->getSpace($direction);

		if($space->isEmpty())
		{
			$this->unit->getPosition()->move($direction);
		}
		elseif($space->isWall())
		{
			$this->unit->addEvent('bumps into a wall');
		}
		elseif($space->isEnnemy())
		{
			$this->unit->addEvent('bumps into '. $this->unit->getSpace($direction)->getUnit());
		}
		else
		{
			throw new \Exception('Walk skill doesn\'t know what to do');
		}
	}
}