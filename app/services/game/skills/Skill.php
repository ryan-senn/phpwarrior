<?php namespace Services\Game\Skills;

use Services\Game\Events;
use Services\Game\Units\Unit;


abstract class Skill
{

	protected $unit;
	protected static $isAction = false;
	protected static $description;


	public function __construct(Unit $unit)
	{
		$this->unit = $unit;
	}


	public static function getDescription()
	{
		return static::$description;
	}


	public static function isAction()
	{
		return static::$isAction;
	}
}