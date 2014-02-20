<?php namespace Services\Game\Maps;

use Services\Game\Maps\Base as BaseMap;
use Services\Game\Map;
use Services\Game\Position;


class Map_1 extends BaseMap
{

	protected $description = 'Your goal is simple: reaching the stairs!<br /><br />Use <code>$this->walk()</code> to accomplish this.';

	protected $skills = ['walk'];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(2, 4);

		$position = new Position($map, 2, 0);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$map->addUnit($warrior);

		return $map;
	}
}