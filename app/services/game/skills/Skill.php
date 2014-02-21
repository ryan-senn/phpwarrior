<?php namespace Services\Game\Skills;

use Services\Game\Events;
use Services\Game\Units\Unit;


abstract class Skill
{

	protected $unit;
	protected static $isAction = false;
	protected static $description = 'no description';


	public function __construct(Unit $unit)
	{
		$this->unit = $unit;
	}


	public static function getDescription($name)
	{
		$skill = 'Services\Game\Skills\\'. ucfirst($name);
		return $skill::$description;
	}


	public static function isAction()
	{
		return static::$isAction;
	}
}