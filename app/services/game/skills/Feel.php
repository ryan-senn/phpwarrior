<?php namespace Services\Game\Skills;


class Feel extends Skill
{

	protected static $description = 'Returns a Space for the given direction (forward by default)';

	
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