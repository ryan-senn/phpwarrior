<?php namespace Services\Game\Maps;

use Services\Game\Map;
use Services\Game\Position;


class map_1
{

	private $skills = ['walk'];


	public static function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(3, 3);

		$position = new Position($map, 1, 0);
		$warrior = new \Warrior($position);
		$map->addUnit($warrior);

		return $map;
	}
}