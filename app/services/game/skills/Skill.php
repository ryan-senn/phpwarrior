<?php namespace Services\Game\Skills;

use Services\Game\Events;
use Services\Game\Units\Unit;


abstract class Skill
{

	protected $unit;


	public function __construct(Unit $unit)
	{
		$this->unit = $unit;
	}
}