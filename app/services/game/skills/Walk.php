<?php namespace Services\Game\Skills;


class Walk extends Skill
{
	
	public function execute($direction = 'forward')
	{
		$this->unit->addEvent('walks '. $direction);

		// if the space is empty, move the unit
		if($this->unit->getSpace($direction)->isEmpty())
		{
			$offset = $this->unit->getOffset($direction);

			$this->unit->getPosition()->move($offset['x'], $offset['y']);
		}
		// if the space is a wall, don't move
		elseif($this->unit->getSpace($direction)->isWall())
		{
			$this->unit->addEvent('bumps into a wall');
		}
		// if the space is an ennemy, don't move
		elseif(($this->unit->getSpace($direction)->isEnnemy()))
		{
			$this->unit->addEvent('bumps into '. $this->unit->getSpace($direction)->getUnit());
		}
	}
}