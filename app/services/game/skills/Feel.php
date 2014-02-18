<?php namespace Services\Game\Skills;


class Feel extends Skill
{

	protected static $description = 'Returns a Space for the given direction (forward by default)';

	
	public function execute($direction = 'forward')
	{
		return $this->unit->getSpace($direction);
	}
}