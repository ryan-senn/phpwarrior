<?php namespace Services\Game\Maps;


abstract class Map
{
	
	protected static $skills = [];
	protected static $helpers = [];


	public static function getSkills()
	{
		return static::$skills;
	}


	public static function getHelpers()
	{
		return static::$helpers;
	}
}