<?php namespace Services\Game\Maps;

use Services\Game\Maps\Base as BaseMap;
use Services\Game\Map;
use Services\Game\Position;


class Map_2 extends BaseMap
{

	protected $description = 'The room apears to be empty again. What a boring dungeon...';
	protected $instruction = 'Use <code>$this->getDirectionOfStairs()</code> to find out which way to walk.';

	protected $skills = ['walk'];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(1, 4);

		$position = new Position($map, 4, 0);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$map->addUnit($warrior);

		return $map;
	}
}