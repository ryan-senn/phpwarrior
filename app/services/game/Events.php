<?php namespace Services\Game;

use Services\Game\Event;


abstract class Events
{

	protected static $turn = 1;
	protected static $events = [];


	public static function add(Event $event)
	{
		self::$events[self::$turn][] = $event;
	}


	public static function endTurn()
	{
		self::$turn += 1;
	}


	public static function all()
	{
		return self::$events;
	}


	public static function getTurn($turn)
	{
		if(!isset(self::$events[$turn]))
		{
			return [];
		}

		return self::$events[$turn];
	}
}