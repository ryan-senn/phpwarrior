<?php namespace Services\Game\Skills;


class Walk extends Skill
{

	protected static $isAction = true;
	protected static $description = 'Walks in a given direction (forward by default)';

	
	public function execute($direction = 'forward')
	{
		$this->unit->addEvent('walks '. $direction);

		$space = $this->unit->getSpace($direction);

		if($space->isEmpty())
		{
			$this->unit->getPosition()->move($direction);
			return;
		}

		if($space->isWall())
		{
			$this->unit->addEvent('bumps into a wall');
			return;
		}

		if($space->isEnnemy())
		{
			$this->unit->addEvent('bumps into '. $this->unit->getSpace($direction)->getUnit());
			return;
		}

		throw new \Exception('walk skill doesnt know what to do');
	}
}