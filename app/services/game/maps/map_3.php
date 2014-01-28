<?php namespace Services\Game\Maps;

use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;


class map_3
{

	private static $skills = ['walk', 'attack', 'drink'];


	public static function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(0, 1);

		$position = new Position($map, 4, 3);
		$warrior = new \Warrior($position);
		$warrior->setSkills(self::$skills);
		$map->addUnit($warrior);

		$position = new Position($map, 0, 3);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		$position = new Position($map, 1, 2);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		return $map;
	}
}