<?php namespace Services\Game\Skills;


class Feel extends Skill
{

	protected static $description = 'Returns a Space for the given direction (forward by default)';

	
	public function execute($direction = 'forward')
	{
		// don't log the senses of creatures
		if($this->unit->isWarrior())
		{
			$this->unit->addEvent('feels '. $direction);
		}
		
		return $this->unit->getSpace($direction);
	}
}